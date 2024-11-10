@extends('coworker_side.side')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" >



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