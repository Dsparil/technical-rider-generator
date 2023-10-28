const T = {
    TOKEN: '{{ csrf_token() }}',
    MEMBER: {
        AJAX_LIST_URL: '{{ url(route('members.list', ['bandId' => '__BAND_ID__'])) }}'
    },
    PATCHLIST: {
        AJAX_LIST_ENUM: '{{ url(route('patchlist.enum')) }}'
    },
    STUFF: {
        AJAX_LIST_ENUM: '{{ url(route('stuff.enum')) }}'
    },
    ITEM: {
        AJAX_LIST_ENUM: '{{ url(route('item.enum')) }}'
    }
};
