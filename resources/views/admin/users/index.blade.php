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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
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
                }
            };
        },
        computed: {
            filteredUsers() {
                return this.users.filter(user => {
                    return user.name.toLowerCase().includes(this.search.toLowerCase()) ||
                           user.email.toLowerCase().includes(this.search.toLowerCase());
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
            }
        },
    }).mount('#app');
</script>
@endsection