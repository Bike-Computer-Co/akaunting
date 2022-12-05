<template>
    <nav v-if="links.length > 3" aria-label="Page navigation example">
        <ul class="pagination justify-content-center mb-0">
            <li
                v-for="(link, k) in links"
                :key="k"
                class="page-item"
                :class="{ active: link.active, disabled: !link.url }"
            >
                <Link
                    v-if="link.url"
                    class="page-link"
                    :href="link.url"
                    tabindex="-1"
                    v-html="link.label"
                />
                <span v-else class="page-link" v-html="link.label" />
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "Pagination",
    props: {
        links: Array,
        required: true,
    },
};
</script>
