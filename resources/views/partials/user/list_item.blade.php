<!--
*User: Joel.DE-SOUSA
-->
<tr>
    <td>{{ $user->firstname }}</td>
    <td>{{ $user->lastname }}</td>
    <td>{{ $user->phone_number }}</td>
    <td>{{ $user->status }}</td>
    <!-- we will also add show, edit, and delete buttons -->
    <td>
        <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
        <a class="btn btn-small btn-success" href="{{ route("users.show",$user) }}">Show this User</a>
    </td>
</tr>
