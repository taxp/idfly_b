$('#add-friend').click(function(e) {
    $('#friends').append(
        '<div class="new-friend">' +
            '<div class="form-group">' +
                '<label class="control-label">Name</label>' +
                '<input type="text" class="form-control" name="friend_name[]">' +
            '</div>' +
            '<div class="form-group">' +
                '<label class="control-label">Position</label>' +
                '<input type="text" class="form-control" name="friend_position[]">' +
            '</div>' +
            '<div class="form-group">' +
                '<label class="control-label">Image</label>' +
                '<input type="hidden" name="friend_image[]" value="">' +
                '<input type="file" name="friend_image[]">' +
            '</div>' +
            '<input type="button" class="btn btn-danger delete-friend" value="Remove">' +
        '</div>');
});

$('#friends').on('click', '.delete-friend', function(e) {
    if(confirm('Are you sure?')) {
        $(e.target).closest('.new-friend').remove();
    }
});