<? 
include 'include.php';
require_once 'recaptcha.php';

$site = $_GET['site'];
?>
<html>
<head>
    <title>
        Submit to us!
    </title>
    <script type="text/javascript">
        window.onload = function () {
            var $recaptcha = document.querySelector('#g-recaptcha-response');

            if ($recaptcha) {
                $recaptcha.setAttribute("required", "");
            }
        };
    </script>
    <style type="text/css">
        #g-recaptcha-response {
            display: block !important;
            position: absolute;
            margin: -78px 0 0 0 !important;
            width: 302px !important;
            height: 76px !important;
            z-index: -999999;
            opacity: 0;
        }
    </style>
</head>

<body>
    <div class="row">
        <form class="col s12" action="submit2.php" method="post">
            <fieldset>
                <legend>Website Information</legend>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Google" name="Name" id="Name" type="text" class="validate" required>
                        <label for="Name">Website Name</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="http://google.com" name="url" id="url" value="<? echo $site; ?>" type="url" class="validate" required>
                        <label for="url" data-error="Please enter a valid URL">Website URL</label>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Password Complexity Requirement</legend>
                <div class="row">
                    <div class="input-field col s6">
                        <input type="checkbox" name="Upper" id="Upper" value="1" />
                        <label for="Upper">Requires Capital/Uppercase Letters</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="checkbox" name="Lower" id="Lower" value="1" />
                        <label for="Lower">Requires Lowercase Letters</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input type="checkbox" name="Numbers" id="Numbers" value="1" />
                        <label for="Numbers">Requires Numbers</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="checkbox" name="Complex" id="Complex" value="1" />
                        <label for="Complex">Requires Complex Characters</label>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Password Length Requirements</legend>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="HasMin" name="HasMin" type="checkbox" onchange="document.getElementById('Min').disabled = !this.checked; document.getElementById('MinMaxSlider').style.display = 'block'; if ( !this.checked ) {document.getElementsByClassName('noUi-origin')[0].setAttribute('disabled', true); } else { document.getElementsByClassName('noUi-origin')[0].removeAttribute('disabled'); }" class="validate" value="1">
                        <label for="HasMin">Has Min Length</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="HasMax" name="HasMax" type="checkbox" onchange="document.getElementById('Max').disabled = !this.checked; document.getElementById('MinMaxSlider').style.display = 'block';  if ( !this.checked ) { document.getElementsByClassName('noUi-origin')[1].setAttribute('disabled', true); } else { document.getElementsByClassName('noUi-origin')[1].removeAttribute('disabled'); }" class="validate" value="1">
                        <label for="HasMax">Has Max Length</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input name="Min" id="Min" type="number" class="validate" disabled>
                        <label for="Min">Min Length</label>
                    </div>
                    <div class="input-field col s6">
                        <input name="Max" id="Max" type="number" class="validate" disabled>
                        <label for="Max">Max Length</label>
                    </div>
                </div>
                <span class="row" id="MinMaxSlider" style="display: none;">
                  <div class="input-field col s12">
                    <slider id="MinMax" type="slider">
                    <!-- <label for="MinMax">Min Max Slider</label> -->
                  </div>
                </span>
            </fieldset>
            <fieldset>
                <legend>Optional User Information</legend>
                <div class="row">
                    <div class="input-field col s6">
                        <input name="username" id="username" type="text" class="validate">
                        <label for="username">Username (Optional)</label>
                    </div>
                    <div class="input-field col s6">
                        <input name="email" id="email" type="email" class="validate">
                        <label for="email" data-error="Please enter a valid email address">Email (Optional)</label>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Submit it!</legend>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="comments" id="comments" class="materialize-textarea"></textarea>
                        <label for="comments">Additional comments</label>
                    </div>
                </div>
                <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
                <br />
                <br />
                <button class="btn waves-effect waves-light" type="submit" name="action">
                  Submit
                  <i class="material-icons right">send</i>
                </button>
            </fieldset>
        </form>
    </div>

    <script type="text/javascript">
        var slider = document.getElementById('MinMax');
        noUiSlider.create(slider, {
            start: [0, 80],
            behaviour: 'drag-tap',
            connect: true,
            step: 1,
            range: {
                'min': 0,
                '95%': 100,
                'max': 9999999999
            },
            format: wNumb({
                decimals: 0
            })
        });

    </script>
    <script type="text/javascript">
        var MaxinputNumber = document.getElementById('Max');
        var MinputNumber = document.getElementById('Min');

        slider.noUiSlider.on('update', function (values, handle) {

            var value = values[handle];

            if (handle) {
                MaxinputNumber.value = Math.round(value);
            } else {
                MinputNumber.value = Math.round(value);
            }
        });

        MaxinputNumber.addEventListener('change', function () {
            slider.noUiSlider.set([null, this.value]);
        });

        MinputNumber.addEventListener('change', function () {
            slider.noUiSlider.set([this.value, null]);
        });
    </script>