@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')



@section('content')
    <div class="container">
        <h1 class="heading-primary">CSS Responsive Animated Accordion</h1>
        <div class="accordion">
            <dl>
                <dt>
                    <a href="#accordion1" aria-expanded="false" aria-controls="accordion1" class="accordion-title accordionTitle js-accordionTrigger">First Accordion heading</a>
                </dt>
                <dd class="accordion-content accordionItem is-collapsed" id="accordion1" aria-hidden="true">
                    <p>Lorem ipsum dolor sit amet, consectetur <a href="https://www.google.com">Test</a>adipiscing elit. Morbi eu interdum diam. Donec interdum porttitor risus non bibendum. Maecenas sollicitudin eros in quam imperdiet placerat. Cras justo purus, rhoncus nec lobortis ut, iaculis vel ipsum. Donec dignissim arcu nec elit faucibus condimentum. Donec facilisis consectetur enim sit amet varius. Pellentesque justo dui, sodales quis luctus a, iaculis eget mauris. </p>
                    <p>Aliquam dapibus, ante quis fringilla feugiat, mauris risus condimentum massa, at elementum libero quam ac ligula. Pellentesque at rhoncus dolor. Duis porttitor nibh ut lobortis aliquam. Nullam eu dolor venenatis mauris placerat tristique eget id dolor. Quisque blandit adipiscing erat vitae dapibus. Nulla aliquam magna nec elementum tincidunt.</p>
                </dd>
                <dt>
                    <a href="#accordion2" aria-expanded="false" aria-controls="accordion2" class="accordion-title accordionTitle js-accordionTrigger">
                        Second Accordion heading</a>
                </dt>
                <dd class="accordion-content accordionItem is-collapsed" id="accordion2" aria-hidden="true">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu interdum diam. Donec interdum porttitor risus non bibendum. Maecenas sollicitudin eros in quam imperdiet placerat. Cras justo purus, rhoncus nec lobortis ut, iaculis vel ipsum. Donec dignissim arcu nec elit faucibus condimentum. Donec facilisis consectetur enim sit amet varius. Pellentesque justo dui, sodales quis luctus a, iaculis eget mauris. </p>
                    <p>Aliquam dapibus, ante quis fringilla feugiat, mauris risus condimentum massa, at elementum libero quam ac ligula. Pellentesque at rhoncus dolor. Duis porttitor nibh ut lobortis aliquam. Nullam eu dolor venenatis mauris placerat tristique eget id dolor. Quisque blandit adipiscing erat vitae dapibus. Nulla aliquam magna nec elementum tincidunt.</p>
                </dd>
                <dt>
                    <a href="#accordion3" aria-expanded="false" aria-controls="accordion3" class="accordion-title accordionTitle js-accordionTrigger">
                        Third Accordion heading
                    </a>
                </dt>
                <dd class="accordion-content accordionItem is-collapsed" id="accordion3" aria-hidden="true">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eu interdum diam. Donec interdum porttitor risus non bibendum. Maecenas sollicitudin eros in quam imperdiet placerat. Cras justo purus, rhoncus nec lobortis ut, iaculis vel ipsum. Donec dignissim arcu nec elit faucibus condimentum. Donec facilisis consectetur enim sit amet varius. Pellentesque justo dui, sodales quis luctus a, iaculis eget mauris. </p>
                    <p>Aliquam dapibus, ante quis fringilla feugiat, mauris risus condimentum massa, at elementum libero quam ac ligula. Pellentesque at rhoncus dolor. Duis porttitor nibh ut lobortis aliquam. Nullam eu dolor venenatis mauris placerat tristique eget id dolor. Quisque blandit adipiscing erat vitae dapibus. Nulla aliquam magna nec elementum tincidunt.</p>
                </dd>
            </dl>
        </div>
    </div>

<style>
    @import url(https://fonts.googleapis.com/css?family=Lato:400,700);
    * {
        box-sizing: border-box;
    }
    body {
        font-family: 'Lato';
    }
    .heading-primary {
        font-size: 2em;
        padding: 2em;
        text-align: center;
    }
    .accordion dl, .accordion-list {
        border: 1px solid #ddd;
    }
    .accordion dl:after, .accordion-list:after {
        content: "";
        display: block;
        height: 1em;
        width: 100%;
        background-color: #2ba659;
    }
    .accordion dd, .accordion__panel {
        background-color: #eee;
        font-size: 1em;
        line-height: 1.5em;
    }
    .accordion p {
        padding: 1em 2em 1em 2em;
    }
    .accordion {
        position: relative;
        background-color: #eee;
    }
    .container {
        max-width: 960px;
        margin: 0 auto;
        padding: 2em 0 2em 0;
    }
    .accordionTitle, .accordion__Heading {
        background-color: #38cc70;
        text-align: center;
        font-weight: 700;
        padding: 2em;
        display: block;
        text-decoration: none;
        color: #fff;
        transition: background-color 0.5s ease-in-out;
        border-bottom: 1px solid #30bb64;
    }
    .accordionTitle:before, .accordion__Heading:before {
        content: "+";
        font-size: 1.5em;
        line-height: 0.5em;
        float: left;
        transition: transform 0.3s ease-in-out;
    }
    .accordionTitle:hover, .accordion__Heading:hover {
        background-color: #2ba659;
    }
    .accordionTitleActive, .accordionTitle.is-expanded {
        background-color: #2ba659;
    }
    .accordionTitleActive:before, .accordionTitle.is-expanded:before {
        transform: rotate(-225deg);
    }
    .accordionItem {
        height: auto;
        overflow: hidden;
        max-height: 50em;
        transition: max-height 1s;
    }
    @media screen and (min-width: 48em) {
        .accordionItem {
            max-height: 15em;
            transition: max-height 0.5s;
        }
    }
    .accordionItem.is-collapsed {
        max-height: 0;
    }
    .no-js .accordionItem.is-collapsed {
        max-height: auto;
    }
    .animateIn {
        animation: accordionIn 0.45s normal ease-in-out both 1;
    }
    .animateOut {
        animation: accordionOut 0.45s alternate ease-in-out both 1;
    }
    @keyframes accordionIn {
        0% {
            opacity: 0;
            transform: scale(0.9) rotateX(-60deg);
            transform-origin: 50% 0;
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    @keyframes accordionOut {
        0% {
            opacity: 1;
            transform: scale(1);
        }
        100% {
            opacity: 0;
            transform: scale(0.9) rotateX(-60deg);
        }
    }

</style>
    <script>

        //uses classList, setAttribute, and querySelectorAll
        //if you want this to work in IE8/9 youll need to polyfill these
        (function(){
            var d = document,
                accordionToggles = d.querySelectorAll('.js-accordionTrigger'),
                setAria,
                setAccordionAria,
                switchAccordion,
                touchSupported = ('ontouchstart' in window),
                pointerSupported = ('pointerdown' in window);

            skipClickDelay = function(e){
                e.preventDefault();
                e.target.click();
            }

            setAriaAttr = function(el, ariaType, newProperty){
                el.setAttribute(ariaType, newProperty);
            };
            setAccordionAria = function(el1, el2, expanded){
                switch(expanded) {
                    case "true":
                        setAriaAttr(el1, 'aria-expanded', 'true');
                        setAriaAttr(el2, 'aria-hidden', 'false');
                        break;
                    case "false":
                        setAriaAttr(el1, 'aria-expanded', 'false');
                        setAriaAttr(el2, 'aria-hidden', 'true');
                        break;
                    default:
                        break;
                }
            };
//function
            switchAccordion = function(e) {
                console.log("triggered");
                e.preventDefault();
                var thisAnswer = e.target.parentNode.nextElementSibling;
                var thisQuestion = e.target;
                if(thisAnswer.classList.contains('is-collapsed')) {
                    setAccordionAria(thisQuestion, thisAnswer, 'true');
                } else {
                    setAccordionAria(thisQuestion, thisAnswer, 'false');
                }
                thisQuestion.classList.toggle('is-collapsed');
                thisQuestion.classList.toggle('is-expanded');
                thisAnswer.classList.toggle('is-collapsed');
                thisAnswer.classList.toggle('is-expanded');

                thisAnswer.classList.toggle('animateIn');
            };
            for (var i=0,len=accordionToggles.length; i<len; i++) {
                if(touchSupported) {
                    accordionToggles[i].addEventListener('touchstart', skipClickDelay, false);
                }
                if(pointerSupported){
                    accordionToggles[i].addEventListener('pointerdown', skipClickDelay, false);
                }
                accordionToggles[i].addEventListener('click', switchAccordion, false);
            }
        })();
    </script>


@endsection
