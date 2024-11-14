@extends('coworker_side.side')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" >

<style>
    .step {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #f1f1f1;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 5px;
    font-weight: bold;
    color: black;
}

.step.active {
    background-color: #000;
    color: white;
}

.progress-line {
    width: 40px;
    height: 2px;
    background-color: #ddd;
}

.progress-line.active {
    background-color: #000;
}

.steps-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}

.step-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0 5px;
    margin-top: 15px;
}

.labels {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}

.label {
    font-size: 12px;
    color: #000;
    text-align: center;
    width: 40px;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}

.label.show {
    opacity: 1;
    visibility: visible;
}


</style>
<div class="steps-container" id="stepper" style="display: none;">
    <!-- Steps and Progress lines (1-8) -->
    <div class="step-container">
        <div class="step active">1</div>
        <div class="label">Details</div>
    </div>
    <div class="progress-line active"></div>

    <div class="step-container">
        <div class="step">2</div>
        <div class="label">Amenities</div>
    </div>
    <div class="progress-line"></div>

    <div class="step-container">
        <div class="step">3</div>
        <div class="label">Location</div>
    </div>
    <div class="progress-line"></div>

    <div class="step-container">
        <div class="step">4</div>
        <div class="label">Size</div>
    </div>
    <div class="progress-line"></div>

    <div class="step-container">
        <div class="step">5</div>
        <div class="label">Images</div>
    </div>
    <div class="progress-line"></div>

    <div class="step-container">
        <div class="step">6</div>
        <div class="label">Payment</div>
    </div>
    <div class="progress-line"></div>

    <div class="step-container">
        <div class="step">7</div>
        <div class="label">Prices</div>
    </div>
    <div class="progress-line"></div>

    <div class="step-container">
        <div class="step">8</div>
        <div class="label">Promotions</div>
    </div>
</div>


<div class="container mt-4 mb-4 hidden-form-container" id="formContainer">
    <!-- Form Sections (1-9 Steps) -->
    <form id="listingForm" {{-- action="{{ route('coworker_side.listSpace') }}" method="POST" enctype="multipart/form-data" --}}>
        @csrf
        <div id="s1" class="section">
            @include('coworker_side.sections.section1')
        </div>
        <div id="s2" class="section" style="display: none;">
            @include('coworker_side.sections.section2')
        </div>
        <div id="s3" class="section" style="display: none;">
            @include('coworker_side.sections.section3')
        </div>
        <div id="s4" class="section" style="display: none;">
            @include('coworker_side.sections.section4')
        </div>
        <div id="s5" class="section" style="display: none;">
            @include('coworker_side.sections.section5')
        </div>
        <div id="s6" class="section" style="display: none;">
            @include('coworker_side.sections.section6')
        </div>
        <div id="s7" class="section" style="display: none;">
            @include('coworker_side.sections.section7')
        </div>
        <div id="s8" class="section" style="display: none;">
            @include('coworker_side.sections.section8')
        </div>
        <div id="s9" class="section" style="display: none;">
            @include('coworker_side.sections.section9')
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function () {
        $('#nextButton1').on('click', moveToNextStepFromStep1);

        $('#nextButton2').on('click', moveToNextStepFromStep2);

        $('#prevButton2').on('click', moveToPreviousStepFromStep2);
        
        $('#nextButton3').on('click', moveToNextStepFromStep3);

        $('#prevButton3').on('click', moveToPreviousStepFromStep3);
        
        $('#nextButton4').on('click', moveToNextStepFromStep4);

        $('#prevButton4').on('click', moveToPreviousStepFromStep4);
        
        $('#nextButton5').on('click', moveToNextStepFromStep5);

        $('#prevButton5').on('click', moveToPreviousStepFromStep5);
        
        $('#nextButton6').on('click', moveToNextStepFromStep6);

        $('#prevButton6').on('click', moveToPreviousStepFromStep6);
        
        $('#nextButton7').on('click', moveToNextStepFromStep7);

        $('#prevButton7').on('click', moveToPreviousStepFromStep7);
        
        $('#nextButton8').on('click', moveToNextStepFromStep8);

        $('#prevButton8').on('click', moveToPreviousStepFromStep8);

        $('#prevButton9').on('click', moveToPreviousStepFromStep9);
        
    });
    
    $(document).ready(function () {
    // Initialize the progress bar display
    updateProgressBar(0);

    $('#nextButton1').on('click', function () {
        moveToNextStepFromStep1();
        updateProgressBar(1);
    });

    $('#nextButton2').on('click', function () {
        moveToNextStepFromStep2();
        updateProgressBar(2);
    });

    $('#nextButton3').on('click', function () {
        moveToNextStepFromStep3();
        updateProgressBar(3);
    });

    $('#nextButton4').on('click', function () {
        moveToNextStepFromStep4();
        updateProgressBar(4);
    });

    $('#nextButton5').on('click', function () {
        moveToNextStepFromStep5();
        updateProgressBar(5);
    });

    $('#nextButton6').on('click', function () {
        moveToNextStepFromStep6();
        updateProgressBar(6);
    });

    $('#nextButton7').on('click', function () {
        moveToNextStepFromStep7();
        updateProgressBar(7);
    });

    $('#nextButton8').on('click', function () {
        moveToNextStepFromStep8();
        updateProgressBar(8);
    });

    // prev

    // $('#prevButton2').on('click', function () {
    //     moveToPreviousStepFromStep(2);
    //     updateProgressBar(1);
    // });

    $('#prevButton3').on('click', function () {
        moveToPreviousStepFromStep3();
        updateProgressBar(1);
    });

    $('#prevButton4').on('click', function () {
        moveToPreviousStepFromStep4();
        updateProgressBar(2);
    });

    $('#prevButton5').on('click', function () {
        moveToPreviousStepFromStep5();
        updateProgressBar(3);
    });

    $('#prevButton6').on('click', function () {
        moveToPreviousStepFromStep6();
        updateProgressBar(4);
    });

    $('#prevButton7').on('click', function () {
        moveToPreviousStepFromStep7();
        updateProgressBar(5);
    });

    $('#prevButton8').on('click', function () {
        moveToPreviousStepFromStep8();
        updateProgressBar(6);
    });

    $('#prevButton9').on('click', function () {
        moveToPreviousStepFromStep9();
        updateProgressBar(7);
    });


    function updateProgressBar(currentStep) {
        $('.step').removeClass('active');
        $('.progress-line').removeClass('active');
        $('.label').removeClass('show'); // Remove show class to hide all labels

        if (currentStep >= 1) {
            $('#stepper').show();
        } else {
            $('#stepper').hide();
        }

        for (let i = 1; i <= currentStep; i++) {
            $('.step').eq(i - 1).addClass('active');
            if (i < currentStep) {
                $('.progress-line').eq(i - 1).addClass('active');
            }
        }

        // Show the label of the current step
        if (currentStep > 0) {
            $('.label').eq(currentStep - 1).addClass('show'); // Add show class to current step label
        }
    }


});

</script>


<script src="{{ asset('js/coworker/section1.js') }}" ></script>
<script src="{{ asset('js/coworker/section2.js') }}" ></script>
<script src="{{ asset('js/coworker/section3.js') }}" ></script>
<script src="{{ asset('js/coworker/section4.js') }}" ></script>
<script src="{{ asset('js/coworker/section5.js') }}" ></script>
<script src="{{ asset('js/coworker/section6.js') }}" ></script>
<script src="{{ asset('js/coworker/section7.js') }}" ></script>
<script src="{{ asset('js/coworker/section8.js') }}" ></script>
<script src="{{ asset('js/coworker/section9.js') }}" ></script>


@endsection