<script setup>
    const model = defineModel({
        type: null, //used to define model as all null
        required: true,
    });

    defineProps({
        name: {
            type: String,
            required: true,
        },
        type: {
            type: String,
            default: 'text',
        },
        message: String
    })
</script>

<template>
    <div class="mb-6">
        <label for="">{{ name }}</label>
            <input :type="type" v-model="model" :class="{'!ring-red-600' :message}"/>
            <small class="text-red-600" v-if="message">{{ message }}</small>
    </div>
</template>
