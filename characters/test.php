<?php // maps currently too profile-rdSTAT.php
require '../_inc/config_inc.php';

?>


<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">


<script>
    /* activate the carousel */
    $("#modal-carousel").carousel({interval:false});

    /* change modal title when slide changes */
    $("#modal-carousel").on("slid.bs.carousel", function () {
        $(".modal-title").html($(this).find(".active img").attr("title"));
    })

    /* when clicking a thumbnail */
    $(".row .thumbnail").click(function(){
        var content = $(".carousel-inner");
        var title = $(".modal-title");

        content.empty();
        title.empty();

        var id = this.id;
        var repo = $("#img-repo .item");
        var repoCopy = repo.filter("#" + id).clone();
        var active = repoCopy.first();

        active.addClass("active");
        title.html(active.find("img").attr("title"));
        content.append(repoCopy);

        // show the modal
        $("#modal-gallery").modal("show");
    });
</script>

<style>
    .modal-dialog {}
    .thumbnail {margin-bottom:6px;}

    .carousel-control.left,.carousel-control.right{
        background-image:none;
        margin-top:10%;
        width:5%;
    }
</style>


<div class="container">
    <div class="row">
        <h1>Bootstrap 3 lightbox hidden gallery using modal</h1>
        <hr>

        <div class="row">

            <div class="col-12 col-md-4 col-sm-6">
                <a title="Image 1" href="#">
                    <img class="thumbnail img-responsive" id="image-1" src="http://dummyimage.com/600x350/ccc/969696&amp;text=0xD10x810xD00xB50xD10x800xD10x8B0xD00xB9">
                </a>
            </div>

            <div class="col-12 col-md-4 col-sm-6">
                <a title="Image 2" href="#">
                    <img class="thumbnail img-responsive" id="image-2" src="http://dummyimage.com/600x350/2255EE/969696&amp;text=0xD10x810xD00xB80xD00xBD0xD00xB80xD00xB9">
                </a>

            </div>
            <div class="col-12 col-md-4 col-sm-6">
                <a title="Image 3" href="#">
                    <img class="thumbnail img-responsive" id="image-3" src="http://dummyimage.com/600x350/449955/FFF&amp;text=0xD00xB70xD00xB50xD00xBB0xD00xB50xD00xBD0xD10x8B0xD00xB9">
                </a>
            </div>
        </div>

        <hr>

    </div>
</div>

<div class="hidden" id="img-repo">

    <!-- #image-1 -->
    <div class="item" id="image-1">
        <img class="thumbnail img-responsive" title="Image 11" src="http://dummyimage.com/600x350/ccc/969696">
    </div>
    <div class="item" id="image-1">
        <img class="thumbnail img-responsive" title="Image 12" src="http://dummyimage.com/600x600/ccc/969696">
    </div>
    <div class="item" id="image-1">
        <img class="thumbnail img-responsive" title="Image 13" src="http://dummyimage.com/300x300/ccc/969696">
    </div>

    <!-- #image-2 -->
    <div class="item" id="image-2">
        <img class="thumbnail img-responsive" title="Image 21" src="http://dummyimage.com/600x350/2255EE/969696">
    </div>
    <div class="item" id="image-2">
        <img class="thumbnail img-responsive" title="Image 21" src="http://dummyimage.com/600x600/2255EE/969696">
    </div>
    <div class="item" id="image-2">
        <img class="thumbnail img-responsive" title="Image 23" src="http://dummyimage.com/300x300/2255EE/969696">
    </div>

    <!-- #image-3-->
    <div class="item" id="image-3">
        <img class="thumbnail img-responsive" title="Image 31" src="http://dummyimage.com/600x350/449955/FFF">
    </div>
    <div class="item" id="image-3">
        <img class="thumbnail img-responsive" title="Image 32" src="http://dummyimage.com/600x600/449955/FFF">
    </div>
    <div class="item" id="image-3">
        <img class="thumbnail img-responsive" title="Image 33" src="http://dummyimage.com/300x300/449955/FFF">
    </div>

</div>

<div class="modal" id="modal-gallery" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body">
                <div id="modal-carousel" class="carousel">

                    <div class="carousel-inner">
                    </div>

                    <a class="carousel-control left" href="#modal-carousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="carousel-control right" href="#modal-carousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


