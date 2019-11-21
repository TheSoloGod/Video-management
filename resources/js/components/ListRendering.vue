<template>
    <div class="list-rendering">
        <ul>
            <li v-for="(value, key, index) of myInfo">
                {{ key }} - {{ value }} - {{ index }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "ListRendering",
        data: function () {
            return {
                myInfo : {
                    name: 'abc',
                    age: '2x',
                    country: 'VN',
                }
            }
        },
    }
</script>

<style scoped>

</style>
