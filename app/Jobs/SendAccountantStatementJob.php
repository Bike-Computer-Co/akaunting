<?php

namespace App\Jobs;

use App\Abstracts\Notification;
use App\Models\Banking\Transaction;
use App\Models\Common\Company;
use App\Models\Document\Document;
use App\Notifications\AccountantStatementNotification;
use App\Notifications\FirmEnrollmentUploadedNotification;
use Carbon\Carbon;
use FilesystemIterator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\Documents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class SendAccountantStatementJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Documents;

    private Company $company;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $startWeek = now()->subWeek()->startOfWeek();
        $endWeek   = now()->subWeek()->endOfWeek();
        $startWeek->startOfDay();
        $endWeek->endOfDay();

        $unique  = uniqid();
        $folderPrefix = "app/temp/$unique";

        $folder = $this->makeStorageDirectory($folderPrefix);
        $this->makeStorageDirectory($folderPrefix, 'invoices');
        $this->makeStorageDirectory($folderPrefix, 'bills');
        $this->makeStorageDirectory($folderPrefix, 'expenses');


        $this->saveInvoices($startWeek, $endWeek, $folderPrefix);
        $this->saveBills($startWeek, $endWeek, $folderPrefix);
        $this->saveExpenses($startWeek, $endWeek, $folderPrefix);

        $zipName = storage_path("app/temp/documents_$unique.zip");
        $this->zipFiles($zipName, $folder);

        File::deleteDirectory($folder);

        $email = $this->company->settings->firstWhere('key', 'company.accountant_email')->value;

        \Illuminate\Support\Facades\Notification::route('mail', $email)
            ->notifyNow(new AccountantStatementNotification($zipName, $this->company));

        File::delete($zipName);
    }

    private function saveExpenses($startWeek, $endWeek, $folderPrefix){

        $this->company->transactions()
            ->where('type', Transaction::EXPENSE_TYPE )
            ->whereBetween('created_at', [$startWeek, $endWeek])
            ->get()
            ->each(function (Transaction $transaction) use ($folderPrefix) {
                $currency_style = true;
                $file_name = $this->getTransactionFileName($transaction);
                $this->savePdf($folderPrefix, "banking.transactions.print_default", compact('transaction', 'currency_style'), $file_name, 'expenses');
            });
    }

    private function saveBills($startWeek, $endWeek, $folderPrefix){
        $this->company->bills()
            ->whereBetween('created_at', [$startWeek, $endWeek])
            ->get()
            ->each(function (Document $bill) use ($folderPrefix) {
                $bill = $this->prepareBill($bill);
                $currency_style = true;
                $file_name = $this->getDocumentFileName($bill);
                $this->savePdf($folderPrefix, "purchases.bills.print", compact('bill', 'currency_style'), $file_name, 'bills');
            });
    }

    private function saveInvoices($startWeek, $endWeek, $folderPrefix){
        $documentTemplatePath = $this->company->settings->firstWhere('key', 'invoice._template')->value;

        $this->company->invoices()
            ->whereBetween('created_at', [$startWeek, $endWeek])
            ->get()
            ->each(function (Document $invoice) use ($documentTemplatePath, $folderPrefix) {
                $currency_style = true;
                $file_name = $this->getDocumentFileName($invoice);
                $this->savePdf($folderPrefix, "sales.invoices.print_$documentTemplatePath", compact('invoice', 'currency_style'), $file_name, 'invoices');
            });
    }

    private function savePdf($folderPrefix, $viewName, $viewParams, $fileName, $folder){
        $view = view($viewName, $viewParams)->render();
        $html = mb_convert_encoding($view, 'HTML-ENTITIES', 'UTF-8');

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($html);
        $name = storage_path("$folderPrefix/$folder/$fileName");
        $pdf->save($name);
    }

    private function zipFiles($zipFilePath, $folderPath)
    {
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            die('Failed to create zip archive');
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folderPath, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            $filePath = $item->getPathName();
            if (!$item->isDir()) {
                $zip->addFile($filePath, substr($filePath, strlen($folderPath) + 1));
            }
        }

        $zip->close();
        echo 'Zip archive created successfully.';
    }

    private function makeStorageDirectory($folderPrefix, $path = ''): string
    {
        $path = storage_path("$folderPrefix/$path");
        File::makeDirectory($path);
        return $path;
    }

    protected function prepareBill(Document $bill)
    {
        $paid = 0;

        foreach ($bill->transactions as $item) {
            $amount = $item->amount;

            if ($bill->currency_code != $item->currency_code) {
                $item->default_currency_code = $bill->currency_code;

                $amount = $item->getAmountConvertedFromDefault();
            }

            $paid += $amount;
        }

        $bill->paid = $paid;

        $bill->template_path = 'purchases.bills.print';

        return $bill;
    }
}
