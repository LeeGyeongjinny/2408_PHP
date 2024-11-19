<template>
    <!-- Props -->
    <h1 class="blue">자식 컴포넌트</h1>
    <div v-for="item in props.data" :key="item">
        <span>{{ item.name }}</span>
    </div>
    <p>{{ props.count }}</p>
    <!-- Slot -->
    <slot></slot>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    'data': Array
    ,'count': Number
});
</script>

<style>

</style>