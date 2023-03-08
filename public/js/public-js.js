function numberWithCommas(x) {
    if (!isNaN(x))
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    else
        return x;
}

$('#no_card').on('keyup', function (e) {
    var val = $(this).val();
    var newval = '';
    val = val.replace(/-/g, '');
    for (var i = 0; i < val.length; i++) {
        if (i % 4 == 0 && i > 0) newval = newval.concat('-');
        newval = newval.concat(val[i]);
    }
    $(this).val(newval);
});

function removeCommas(str) {
    while (str.search(",") >= 0) {
        str = (str + "").replace(',', '');
    }
    return str;
}

function toEnglishNumber(strNum, name) {
    var pn = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
    var en = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];

    var cache = strNum;
    for (var i = 0; i < 10; i++) {
        var regex_fa = new RegExp(pn[i], 'g');
        cache = cache.replace(regex_fa, en[i]);
    }
    return cache;
}

function checkCartDigit(code) {
    var L = code.length;
    if (L < 16 || parseInt(code.substr(1, 10), 10) == 0 || parseInt(code.substr(10, 6), 10) == 0) return false;
    var c = parseInt(code.substr(15, 1), 10);
    var s = 0;
    var k, d;
    for (var i = 0; i < 16; i++) {
        k = (i % 2 == 0) ? 2 : 1;
        d = parseInt(code.substr(i, 1), 10) * k;
        s += (d > 9) ? d - 9 : d;
    }
    return ((s % 10) == 0);
}

var availableBankLogos = {
    610433: "mellat",
    589905: "melli",
    170019: "melli",
    603799: "melli",
    603769: "saderat",
    639217: "keshavarzi",
    603770: "keshavarzi",
    589210: "sepah",
    627353: "tejarat",
    628023: "maskan",
    207177: "tose_saderat",
    627648: "tose_saderat",
    627961: "sanat_madan",
    627760: "postbank",
    621986: "saman",
    627412: "eghtesad_novin",
    639347: "pasargad",
    502229: "pasargad",
    639607: "sarmaye",
    627488: "karafarin",
    639194: "parsian",
    622106: "parsian",
    639346: "sina",
    589463: "refah",
    628157: "etebari_tose",
    504706: "shahr",
    502806: "shahr",
    502908: "tose_teavon",
    502938: "dey",
    606373: "gharzolhasane_mehr",
    639370: "etebari_mehr",
    627381: "ansar",
    636214: "ayandeh",
    636949: "hekmat_iranian",
    505785: "iran_zamin",
    505416: "gardeshgari",
    636795: "markazi",
    504172: "resalat",
    505801: "kosar",
    505809: "khavarmianeh",
    507677: "noor",
    606256: "melal",
    639599: "ghavamin"
};

function isBankLogoAvailable(e) {
    return e = parseInt(e), !!availableBankLogos[e]
}

(function ($) {
    $.fn.inputFilter = function (inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    };
}(jQuery));

function readURL(input, type = null) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            if (type == null) {
                $('.image-upload-wrap').hide();
                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();
            } else {
                $('.image-upload-wrap-' + type).hide();
                $('.file-upload-image-' + type).attr('src', e.target.result);
                $('.file-upload-content-' + type).show();
            }
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        if (type == null) {
            removeUpload();
        } else {
            removeUpload(type);
        }
    }
}

function removeUpload(type = null) {
    if (type == null) {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
    } else {
        $('.file-upload-input-' + type).replaceWith($('.file-upload-input-' + type).clone());
        $('.file-upload-content-' + type).hide();
        $('.image-upload-wrap-' + type).show();
    }
}

$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
});
$('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});

function DP_Persian() {
    $('.DatePickerPersian').persianDatepicker({
        format: 'YYYY/MM/DD',
        autoClose: true,
        "responsive": true,
        "position": "auto",
        "initialValue": false,
        initialValueType: 'persian',
        calendar: {
            persian: {
                locale: 'fa'
            }
        },
        viewMode: 'year',
        toolbox: {
            calendarSwitch: {
                enabled: false
            }
        }
    });
}

function setBankLogo() {
    $(".banklogo").children().remove();
    var e = document.getElementById("no_card").value.replace(/-/g, "");
    if (e.length >= 6) {
        var n = e.substring(0, 6);
        if (isBankLogoAvailable(n)) {
            $("#bankLogo").attr("src", "public/images/bank-logo/" + availableBankLogos[n] + ".png");
            $("#logo_name").val(availableBankLogos[n]);
        }
    } else {
        $("#bankLogo").attr("src", "public/images/onlinePayment3.png");
        $("#logo_name").val("bank");
    }
}