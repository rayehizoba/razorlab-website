@push('styles')
@endpush
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg md:px-4">
            <h2 class="w-full text-3xl font-semibold text-center">Posts</h2>
            <table id="dataTable" class="row-border w-full">
                <thead class="">
                    <tr>
                        <th class="w-[20px]">ID</th>
                        <th>Title</th>
                        <th class="w-[200px] text-right">Published</th>
                        <th class="w-[200px] text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td class="flex justify-center">
                                @if ($post->status)
                                    <button
                                    onclick="Livewire.emit('openModal', 'modals.publish-post', { postId:{{ $post->id }} })"
                                        class="bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded"
                                        >
                                        YES
                                    </button>
                                @else
                                    <button
                                    onclick="Livewire.emit('openModal', 'modals.publish-post', { postId:{{ $post->id }} })"
                                        class="bg-danger-500 hover:bg-danger-700 text-white font-bold py-2 px-4 rounded"
                                        >
                                        NO
                                    </button>
                                @endif


                            </td>
                            <td>
                                <a href="{{ route('edit-post', $post->id) }}"
                                    class="py-3 px-[30px] rounded-md bg-blue-600 text-white font-semibold">Edit</a>
                                <button
                                    onclick="Livewire.emit('openModal', 'modals.delete-post', { postId:{{ $post->id }} })"
                                    class="py-2 px-2 rounded-md bg-danger-600 text-white font-semibold min-w-[100px]">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dataTable = new DataTable(document.getElementById('dataTable'));
        });
    </script>
@endpush
