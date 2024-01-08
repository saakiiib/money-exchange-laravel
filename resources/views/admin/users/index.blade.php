@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0">Users</h1>
                </div>
                <div class="card-body">
                    <input type="text" v-model="search" class="form-control mb-3" placeholder="Search users...">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th @click="sortBy('id')">ID <span
                                        :class="{'arrow-up': sortKey === 'id' && sortOrders['id'] === 1, 'arrow-down': sortKey === 'id' && sortOrders['id'] === -1}"></span>
                                </th>
                                <th @click="sortBy('name')">Name <span
                                        :class="{'arrow-up': sortKey === 'name' && sortOrders['name'] === 1, 'arrow-down': sortKey === 'name' && sortOrders['name'] === -1}"></span>
                                </th>
                                <th @click="sortBy('email')">Email <span
                                        :class="{'arrow-up': sortKey === 'email' && sortOrders['email'] === 1, 'arrow-down': sortKey === 'email' && sortOrders['email'] === -1}"></span>
                                </th>
                                <th @click="sortBy('role')">Role <span
                                        :class="{'arrow-up': sortKey === 'role' && sortOrders['role'] === 1, 'arrow-down': sortKey === 'role' && sortOrders['role'] === -1}"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in filteredUsers" :key="user.id">
                                <td>@{{ user.id }}</td>
                                <td>@{{ user.name }}</td>
                                <td>@{{ user.email }}</td>
                                <td>@{{ user.role }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Add User</h2>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitForm">
                        <div class="mb-3">
                            <label for="name">Name:</label>
                            <input v-model="formData.name" type="text" id="name" name="name" required
                                class="form-control" placeholder="Enter name">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email:</label>
                            <input v-model="formData.email" type="email" id="email" name="email" required
                                class="form-control" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="password">Password:</label>
                            <input v-model="formData.password" type="password" id="password" name="password" required
                                class="form-control" placeholder="Enter password">
                        </div>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .arrow-up::before {
        content: '\25B2';
    }

    .arrow-down::before {
        content: '\25BC';
    }
</style>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
    const { createApp } = Vue;

    createApp({
        data() {
            return {
                users: @json($users->items()),
                search: '',
                formData: {
                    name: '',
                    email: '',
                    password: ''
                },
                sortKey: '',
                sortOrders: {
                    id: 1,
                    name: 1,
                    email: 1,
                    role: 1
                }
            };
        },
        computed: {
            sortedUsers() {
                const key = this.sortKey;
                const order = this.sortOrders[key] || 1;
                const array = this.users.slice();
                return array.sort((a, b) => {
                    const modifier = order === 1 ? 1 : -1;
                    if (a[key] < b[key]) return -1 * modifier;
                    if (a[key] > b[key]) return 1 * modifier;
                    return 0;
                });
            },
            filteredUsers() {
                const searchLower = this.search.toLowerCase();

                return this.sortedUsers.filter(user => {
                    return user.name.toLowerCase().includes(searchLower) ||
                           user.email.toLowerCase().includes(searchLower);
                });
            }
        },
        methods: {
            submitForm() {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('{{ route('admin.users.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(this.formData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Server error');
                    }
                    return response.json();
                })
                .then(data => {
                    this.users.push(data);

                    this.formData.name = '';
                    this.formData.email = '';
                    this.formData.password = '';

                    this.displaySuccessMessage('User added successfully.');
                })
                .catch(error => {
                    console.error(error);
                });
            },
            displaySuccessMessage(message) {
                alert(message);
            },
            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
            }
        },
    }).mount('#app');
</script>
@endsection