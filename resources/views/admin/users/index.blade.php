@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0">Users</h1>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            @endforeach
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
                    <div id="app">
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
                                <input v-model="formData.password" type="password" id="password" name="password"
                                    required class="form-control" placeholder="Enter password">
                            </div>
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </form>
                    </div>
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
                formData: {
                    name: '',
                    email: '',
                    password: ''
                }
            };
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
                        const tableBody = document.querySelector('.table tbody');
                        const newRow = tableBody.insertRow(-1);
                        newRow.insertCell(0).innerText = data.name;
                        newRow.insertCell(1).innerText = data.email;

                        // Reset the form data for new usage
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
        }
    }).mount('#app');
</script>
@endsection