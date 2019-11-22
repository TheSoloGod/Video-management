<template>
    <div class="list-user">
        <table class="table-list-user">
            <thead>
                <th>Name</th>
                <th>Location</th>
                <th>DOB</th>
            </thead>
            <tbody>
                <tr v-for="user in userData">
                    <td>
                        <a @click="selectUser(user)">{{ user.name.title }} - {{ user.name.last }} {{ user.name.first }}</a>
                    </td>
                    <td>{{ user.location.city }}</td>
                    <td>{{ user.dob }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import data from './data'
    export default {
        name: "ListUser",
        data() {
            return {
                userData: data,
                number: 1412,
                string: 'KID',
            }
        },
        methods: {
            selectUser(user) {
                this.$emit('userSelected', user, this.number, this.string)
            }
        }
    }
</script>

<style lang="scss" scoped>
    .table-list-user {
        width: 100%;
    }
</style>
