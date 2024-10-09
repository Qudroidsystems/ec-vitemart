<script setup>
import { Head, Link  } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { computed } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    // document.getElementById('screenshot-container')?.classList.add('!hidden');
    // document.getElementById('docs-card')?.classList.add('!row-span-1');
    // document.getElementById('docs-card-content')?.classList.add('!flex-row');
    // document.getElementById('background')?.classList.add('!hidden');
}
</script>

<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { usePage  } from '@inertiajs/vue3';

    const page = usePage();

    var five_categories = computed(() => page.props.five_categories);

    export default {
        layout: (h, page) => h(AuthenticatedLayout, [page]),
    }

</script>

<template>
    <Head title="Welcome" />     
       
</template>
