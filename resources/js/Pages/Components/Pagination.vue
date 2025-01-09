<script setup>
    defineProps({
        paginator: {
            type: Object,
            required: true,
        },
    });

    const makeLabel = (label) => {
        if(label.includes("Previous")){
            return "<<";
        } else if(label.includes("Next")){
            return ">>";
        } else {
            return label;
        }
    }
</script>
<template>
    <div class="flex justify-between items-start mt-5">
        <div>
            <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium">
                    {{ paginator.from }}
                </span>
                to
                <span class="font-medium">
                    {{ paginator.to }}
                </span>
                of
                <span class="font-medium">
                    {{ paginator.total }}</span>
                results
            </p>
        </div>
        <div class="flex items-center rounded-md overflow-hidden shadow-lg">
            <div v-for="link in paginator.links" :key="link.url">
                <component 
                    :is="link.url ? 'Link' : 'span'"
                    :href="link.url"
                    :per-page=5
                    v-html="makeLabel(link.label)"
                    class="border-x border-slate-50 w-12 h-12 grid place-items-center bg-white"
                    :class="{
                        'hover:bg-slate-300' : link.url,
                        'text-zinc-400' : !link.url,
                        'font-bold text-blue-500' : link.active,
                    }" 
                />
            </div>
        </div>
    </div>
</template>