<footer id="footer" class="clearfix">
    <div class="container footer-columns">
        <div class="row container">
            <div class="widget about col-xs-12 col-sm-4 col-md-4">
                <div class="footer-logo">
                    <img class="img-responsive"
                        src="https://img.favpng.com/9/23/19/movie-logo-png-favpng-nRr1DmYq3SNYSLN8571CHQTEG.jpg"
                        alt="Phim hay 2021- Xem phim hay nhất" />
                </div>
                Liên hệ QC: <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                    data-cfemail="e5958d8c888d849ccb868aa58288848c89cb868a88">[email&#160;protected]</a>
            </div>
        </div>
    </div>
</footer>
<div id='easy-top'></div>

<script type='text/javascript' src='{{ asset('js/bootstrap.min.js') }}' id='bootstrap-js'></script>
<script type='text/javascript' src='{{ asset('js/owl.carousel.min.js') }}' id='carousel-js'></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0"
    nonce="Lev9y8dH"></script>
<script type='text/javascript' src='{{ asset('js/halimtheme-core.min.js') }}' id='halim-init-js'></script>
<script type='text/javascript'>
    $(".watch_trailer").click(function(e) {
        e.preventDefault();
        var aid = $(this).attr("href");
        $('html,body').animate({
            scrollTop: $(aid).offset().top
        }, 'slow');
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#timkiem').on("keyup",function() {
            $('#result').html('');
            var search = $('#timkiem').val();
            if (search != '') {
                $('#result').css('display', 'inherit')
                var expression = new RegExp(search, "i");
                $.getJSON('public/json/movies.json', function(data) {
                    $.each(data, function(key, value) {
                        if (value.title.search(expression) != -1) {
                            $('#result').append(
                                '<li style="cursor:pointer; display: flex; max-height: 200px;" class="list-group-item link-class"><img src="public/image/movie/' +
                                value.image +
                                '" width="60" height="40"/><div style="flex-direction: column; margin-left: 10px;"><h4 width="80%">' +
                                value.title +
                                '</h4><span style="display: -webkit-box; max-height: 8.2rem; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; white-space: normal; -webkit-line-clamp: 5; line-height: 1.6rem;" class="text-muted">| ' +
                                value.description + '</span></div></li>');
                        }
                    });
                });
            } else {
                $('#result').css('display', 'none')
            }
        });
        $('#result').on('click', function() {
            var click_next = $(this).text().split('|');

            $('#timkiem').val($.trim(click_next[0]));
            $('#result').html('');
            $('#result').css('display', 'none');
        });
    });
</script>
<style>
    #overlay_mb {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 99999;
        cursor: pointer
    }

    #overlay_mb .overlay_mb_content {
        position: relative;
        height: 100%
    }

    .overlay_mb_block {
        display: inline-block;
        position: relative
    }

    #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
        width: 600px;
        height: auto;
        position: relative;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        text-align: center
    }

    #overlay_mb .overlay_mb_content .cls_ov {
        color: #fff;
        text-align: center;
        cursor: pointer;
        position: absolute;
        top: 5px;
        right: 5px;
        z-index: 999999;
        font-size: 14px;
        padding: 4px 10px;
        border: 1px solid #aeaeae;
        background-color: rgba(0, 0, 0, 0.7)
    }

    #overlay_mb img {
        position: relative;
        z-index: 999
    }

    @media only screen and (max-width: 768px) {
        #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
            width: 400px;
            top: 3%;
            transform: translate(-50%, 3%)
        }
    }

    @media only screen and (max-width: 400px) {
        #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
            width: 310px;
            top: 3%;
            transform: translate(-50%, 3%)
        }
    }
</style>

<style>
    #overlay_pc {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 99999;
        cursor: pointer;
    }

    #overlay_pc .overlay_pc_content {
        position: relative;
        height: 100%;
    }

    .overlay_pc_block {
        display: inline-block;
        position: relative;
    }

    #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
        width: 600px;
        height: auto;
        position: relative;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    #overlay_pc .overlay_pc_content .cls_ov {
        color: #fff;
        text-align: center;
        cursor: pointer;
        position: absolute;
        top: 5px;
        right: 5px;
        z-index: 999999;
        font-size: 14px;
        padding: 4px 10px;
        border: 1px solid #aeaeae;
        background-color: rgba(0, 0, 0, 0.7);
    }

    #overlay_pc img {
        position: relative;
        z-index: 999;
    }

    @media only screen and (max-width: 768px) {
        #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
            width: 400px;
            top: 3%;
            transform: translate(-50%, 3%);
        }
    }

    @media only screen and (max-width: 400px) {
        #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
            width: 310px;
            top: 3%;
            transform: translate(-50%, 3%);
        }
    }
</style>

<style>
    .float-ck {
        position: fixed;
        bottom: 0px;
        z-index: 9
    }

    * html .float-ck

    /* IE6 position fixed Bottom */
        {
        position: absolute;
        bottom: auto;
        top: expression(eval (document.documentElement.scrollTop+document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop, 10)||0)-(parseInt(this.currentStyle.marginBottom, 10)||0)));
    }

    #hide_float_left a {
        background: #0098D2;
        padding: 5px 15px 5px 15px;
        color: #FFF;
        font-weight: 700;
        float: left;
    }

    #hide_float_left_m a {
        background: #0098D2;
        padding: 5px 15px 5px 15px;
        color: #FFF;
        font-weight: 700;
    }

    span.bannermobi2 img {
        height: 70px;
        width: 300px;
    }

    #hide_float_right a {
        background: #01AEF0;
        padding: 5px 5px 1px 5px;
        color: #FFF;
        float: left;
    }
</style>
