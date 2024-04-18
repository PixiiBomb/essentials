$(function() {

    // navbar.blade.php
    /*$container = $('#Sub-Navigation-Views-Container');
    const ACTIVE = 'active';
    const COLLAPSE = 'collapse';

    let $activeSubnav = null;


    $('.nav-item').click(function(){
        let id =  $(this).data('subnav');
        if(id == null)
           return;

        let $subnav = $('#'+id);
        $activeSubnav = $subnav;
        $subnav.addClass(ACTIVE);
        $container.addClass(ACTIVE);
    });

    $container.on('mouseleave', closeSubNavigation);

    $('#Close-Sub-Navigation').on('click', closeSubNavigation);

    function closeSubNavigation()
    {
        $container.removeClass(ACTIVE);
        if($activeSubnav != null)
            $activeSubnav.removeClass(ACTIVE);
    }

    // youtube.blade.php
    let $activeItem = null;
    let $activePlaylist = $('.playlist-list li:first');

    setActivePlaylist($activePlaylist);

    $('.playlist-item').click(function(){
        removePreviousActives();
        setActivePlaylist($(this));
    });

    function removePreviousActives()
    {
        if($activeItem != null)
            $activeItem.removeClass(ACTIVE);
        if($activePlaylist != null)
            $activePlaylist.removeClass(ACTIVE);
    }

    function setActivePlaylist($item)
    {
        let id = $item.data('playlist');
        let $playlist = $('#'+id);

        $item.addClass(ACTIVE);
        $playlist.addClass(ACTIVE);
        $activePlaylist = $playlist;
        $activeItem = $item;
    }*/


});
