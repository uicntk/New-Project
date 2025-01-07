<script setup>
defineProps({
    user: String
})
</script>
<template>
    <h1>
        ASB {{ $page.props.auth.user.name }}
    </h1>
</template>