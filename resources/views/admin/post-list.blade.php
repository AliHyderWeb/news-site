    @foreach($posts as $post)
    <tr>
        <td class='id'>{{ $post->id }}</td>
        <td>{{ ucfirst($post->title) }}</td>
        <td>{{ $post->category->category_name }}</td>
        <td>{{ date('d M, Y', strtotime($post->created_at)) }}</td>
        <td>{{ $post->user->first_name ?? 'Unknown' }}</td>
        <td>{{ ucfirst($post->status ?? 'N/A') }}</td>
        <td> <a href="{{ route('post.pdf', $post->id) }}"><i class='fa fa-download'></i></a> </td>

        @if(Auth::user()->role == 'admin')
        <td>
            <button class="btn-primary action-btn" data-id="{{ $post->id }} " data-status='approved' {{ $post->status == 'approved' || $post->status == 'rejected'  ? 'disabled' : '' }}>Approve</button>
            <button class="btn-danger action-btn" data-id="{{ $post->id }}"   data-status='rejected' {{ $post->status == 'approved' || $post->status == 'rejected'? 'disabled' : '' }}>Reject</button>
        </td>
        @endif
        @if($post->status == 'approved' || $post->status == 'rejected')
            <td class='edit'> <a href="javascript:void(0)" class="disabled-link" title="Edit disabled"><i class='fa fa-edit'></i></a></td>
            <td class='delete'> <button type="button" class="disabled-btn" disabled><i class='fa fa-trash-o'></i></button></td>
        @else
        <td class='edit'><a href="{{ route('posts.edit', $post->id) }}"><i class='fa fa-edit'></i></a></td>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <td class='delete'><button type="submit" onclick="return confirm('Are you sure?')"><i class='fa fa-trash-o'></i></button></td>
        </form>
        @endif
    </tr>
    @endforeach

    @if($posts->isEmpty())
    <tr>
        @if(Auth::user()->role == 'admin')
            <td colspan="10" class="text-center">No posts available</td>
        @else
            <td colspan="9" class="text-center">No posts available</td>
        @endif
    </tr>
    @endif

    <tr>
        <td colspan="10">
            @if($posts->hasPages())
                {{ $posts->links('pagination::bootstrap-4') }}
            @endif
            <br>
            Total records: {{ $posts->total() }} 
            Current Page: {{  $posts->currentPage() }}
        </td>
    </tr>
    <style>
    .disabled-link {
        pointer-events: none;
        color: #999;
        cursor: not-allowed;
    }
    .disabled-btn {
        background-color: #ccc;
        cursor: not-allowed;
    }
    </style>    