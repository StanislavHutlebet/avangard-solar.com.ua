jQuery(function ($) {
    $("select").styler();

    let ajaxTimer;

    function loadPosts(page = 1) {
        const search = $('.blog-home-search-box input').val().trim();
        const category = $('.blog-home-body-sort-category select').val();
        const tags = [];

        $('.blog-home-body-left-tag-item.sort-style-checkbox-item.active').each(function () {
            const tag = $(this).data('tag');
            if (tag) tags.push(tag);
        });

        const data = new FormData();
        data.append('action', 'blog_filter');
        data.append('page', page);
        data.append('search', search);
        data.append('category', category);

        tags.forEach(tag => data.append('tags[]', tag));

        fetch(blogAjax.ajaxurl, {
            method: 'POST',
            body: data
        })
            .then(res => res.json())
            .then(res => {
                $('.blog-list').html(res.html);
                $('.blog-home-body-right-count-post span').text(res.total);
                renderPagination(res.current, res.max_pages);
            });
    }


    function renderPagination(current, max) {
        const container = $('.main-pagination .nav-links');
        container.empty();
        if (max <= 1) return;

        if (current > 1) {
            container.append('<a href="#" class="prev page-numbers">‹</a>');
        }

        for (let i = 1; i <= max; i++) {
            container.append('<a href="#" class="page-numbers' + (i === current ? ' current' : '') + '">' + i + '</a>');
        }

        if (current < max) {
            container.append('<a href="#" class="next page-numbers">›</a>');
        }
    }

    $(document).on('click', '.main-pagination .page-numbers', function (e) {
        e.preventDefault();
        const page = parseInt($(this).text());
        if (!isNaN(page)) {
            loadPosts(page);
        } else if ($(this).hasClass('prev')) {
            const curr = parseInt($('.main-pagination .page-numbers.current').text());
            loadPosts(curr - 1);
        } else if ($(this).hasClass('next')) {
            const curr = parseInt($('.main-pagination .page-numbers.current').text());
            loadPosts(curr + 1);
        }
    });

    $(document).on('click', '.blog-home-body-left-tag-item', function () {
        if ($(this).data('tag') === '') {
            $('.blog-home-body-left-tag-item').removeClass('active');
            $(this).addClass('active');
        } else {
            $(this).toggleClass('active');
            $('.blog-home-body-left-tag-item[data-tag=""]').removeClass('active');
        }
        loadPosts(1);
    });

    $(document).on('change', '.blog-home-body-sort-category select', function () {
        loadPosts(1);
    });

    $('.blog-home-search-box input').on('input', function () {
        clearTimeout(ajaxTimer);
        const val = $(this).val().trim();
        if (val.length === 0 || val.length > 3) {
            ajaxTimer = setTimeout(function () {
                loadPosts(1);
            }, 500);
        }
    });

    $('.blog-home-clear-filter').on('click', function () {
        $('.blog-home-search-box input').val('');

        const $select = $('.blog-home-body-sort-category select');
        $select.val('');
        $select.trigger('refresh');

        $('.blog-home-body-left-tag-item').removeClass('active');
        $('.blog-home-body-left-tag-item[data-tag=""]').addClass('active');

        loadPosts(1);
    });

    loadPosts();


});