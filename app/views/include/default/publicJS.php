<script src="public/js/default/livewire.js" data-turbo-eval="false" data-turbolinks-eval="false"></script>
<script data-turbo-eval="false" data-turbolinks-eval="false">
    window.livewire = new Livewire();
    window.Livewire = window.livewire;
    window.livewire_app_url = '';
    window.livewire_token = 'F1ZEp9fglIVsXpo32cLccnssjoonLcyydWwEWGnA';
    window.deferLoadingAlpine = function (callback) {
        window.addEventListener('livewire:load', function () {
            callback();
        });
    };
    let started = false;
    window.addEventListener('alpine:initializing', function () {
        if (!started) {
            window.livewire.start();
            started = true;
        }
    });
    document.addEventListener("DOMContentLoaded", function () {
        if (!started) {
            window.livewire.start();
            started = true;
        }
    });
</script>
<script src="public/js/default/app.js"></script>
<script src="public/panel/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="public/js/public-js.js"></script>

<script>
    $(".add-like").on('click', function () {
        var thisItem = $(this);
        var newVal;
        if (!thisItem.hasClass('login_req')) {
            var formData = new FormData();
            formData.append("id", thisItem.data('id'));
            formData.append("type", thisItem.data('type'));
            formData.append("part", thisItem.data('part'));
            $.ajax({
                url: "user/userLike",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);

                    if (data.status == "add") {
                        if (thisItem.data('view') == "icon") {
                            $(".likeIcon").removeClass('text-dark-350').addClass("text-red-450");
                            $(".likeCounter").removeClass('text-dark-550').addClass("text-red-450");
                            newVal = parseInt($(".likeCounter").text()) + 1;
                            $(".likeCounter").html(newVal);
                        } else {
                            document.getElementById("likeIcon-" + thisItem.data('id')).style.fill = "currentColor";
                            newVal = parseInt($(".likeCounter-" + thisItem.data('id')).text()) + 1;
                            $(".likeCounter-" + thisItem.data('id')).html(newVal);
                        }
                    } else if (data.status == "remove") {
                        if (thisItem.data('view') == "icon") {
                            $(".likeIcon").removeClass('text-red-450').addClass("text-dark-350");
                            $(".likeCounter").removeClass('text-red-450').addClass("text-dark-550");
                            newVal = parseInt($(".likeCounter").text()) - 1;
                            $(".likeCounter").html(newVal);
                        } else {
                            document.getElementById("likeIcon-" + thisItem.data('id')).style.fill = "none";
                            newVal = parseInt($(".likeCounter-" + thisItem.data('id')).text()) - 1;
                            $(".likeCounter-" + thisItem.data('id')).html(newVal);
                        }
                    }
                },
            });
        } else {
            warningtoast.fire({title: "برای لایک کردن ابتدا نیاز است وارد سایت شوید."});
        }
    });
</script>

<script>
    $(".add-bookmark").on('click', function () {
        var thisItem = $(this);
        var newVal;
        if (!thisItem.hasClass('login_req')) {
            var formData = new FormData();
            formData.append("id", thisItem.data('id'));
            formData.append("type", thisItem.data('type'));
            $.ajax({
                url: "user/addOrDeleteBookmark",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);

                    if (data.status == "add") {
                        if (thisItem.data('type') == "blog") {
                            $(".add-bookmark").removeClass('text-gray-300').addClass("text-blue-700");
                            document.getElementById("bookmarkIcon-" + thisItem.data('id')).style.fill = "currentColor";
                        } else {
                            $(".bookmarkIcon").removeClass('text-gray-300').addClass("text-blue-700");
                            $(".bookmarkCounter").removeClass('text-dark-550').addClass("text-blue-700");
                            newVal = parseInt($(".bookmarkCounter").text()) + 1;
                            $(".bookmarkCounter").html(newVal);
                        }
                    } else if (data.status == "remove") {
                        if (thisItem.data('type') == "blog") {
                            $(".add-bookmark").removeClass('text-blue-700').addClass("text-gray-300");
                            document.getElementById("bookmarkIcon-" + thisItem.data('id')).style.fill = "none";
                        } else {
                            $(".bookmarkIcon").removeClass('text-blue-700').addClass("text-gray-300");
                            $(".bookmarkCounter").removeClass('text-blue-700').addClass("text-dark-550");
                            newVal = parseInt($(".bookmarkCounter").text()) - 1;
                            $(".bookmarkCounter").html(newVal);
                        }
                    }
                },
            });
        } else {
            warningtoast.fire({title: "برای بوکمارک کردن ابتدا نیاز است وارد سایت شوید."});
        }
    });
</script>

<script>
    $(".add-rating").on('click', function () {
        var thisItem = $(this);
        if (!thisItem.hasClass('login_req')) {
            var formData = new FormData();
            formData.append("id", thisItem.parent().data('id'));
            formData.append("type", thisItem.parent().data('type'));
            formData.append("rate", thisItem.data('rate'));
            $.ajax({
                url: "user/addRating",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);

                    if (data.status == "add") {
                        successtoast.fire({title: "امتیاز شما با موفقیت ثبت شد."});
                        $("#ratingCount").css('width', data.data.score);
                        $("#ratingInfo").text((data.data.sum / data.data.count) + " از " + data.data.count + " رای");
                    } else if (data.status == "exist") {
                        warningtoast.fire({title: data.msg});
                    }
                },
            });
        } else {
            warningtoast.fire({title: "برای ثبت امتیاز ابتدا نیاز است وارد سایت شوید."});
        }
    });
</script>

<script>
    function deleteItemCart(id, from) {
        var formData = new FormData();
        formData.append("id", id);
        formData.append("from", from);
        $.ajax({
            url: "cart/cartDelete",
            data: formData,
            type: "POST",
            processData: false,
            contentType: false,
            success: function (data) {
                data = JSON.parse(data);

                if (data.status == "success") {
                    successtoast.fire({title: data.msg});
                    if ($(".addToCart").size() > 0) {
                        $(".addToCart").removeClass("hidden");
                    }
                    if ($(".goToCart").size() > 0) {
                        $(".goToCart").addClass("hidden");
                    }
                    $("#cartDropDown").html("").html(data.data.html);
                    if (data.data.cart > 0) {
                        $(".showNumInCart").removeClass("hidden").html(data.data.cart);
                    } else {
                        $(".showNumInCart").addClass("hidden");
                    }
                } else {
                    errortoast.fire({title: data.msg});
                }
            },
        });
    }
</script>

<script>
    var timeout_iter = 0;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="<?= $data['getPublicInfo']['csrf_token_name'] ?>"]').attr('content')
        },
        timeout: 25000,
        error: function (xhr, status, error) {
            if (status == 'timeout') {
                timeout_iter++;
                if (timeout_iter <= 2) {
                    return;
                } else {
                    warningtoast.fire({title: 'پاسخی از سرور دریافت نشد'});
                }
            } else if (xhr.status == 500) {
                warningtoast.fire({title: 'لطفا دوباره تلاش کنید'});
            } else if (xhr.readyState == 0) {
                warningtoast.fire({title: 'خطا در ارتباط اینترنتی لطفا دوباره تلاش کنید'});
            }
        }
    });
</script>

<?php if ($data['getPublicInfo']['customJS_position'] == "bottom") { ?>
    <!-- start custom js-->
    <?= htmlspecialchars_decode($data['getPublicInfo']['customJS']); ?>
    <!-- end custom js-->
<?php } ?>

<?php if($data['getPublicInfo']['float_contact'] == 1){ ?>
    <!-- start float contact js-->
    <?php require('app/views/include/float_contact.php'); ?>
    <!-- end float contact js-->
<?php } ?>