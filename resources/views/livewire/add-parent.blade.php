<div>
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif

    @if ($catchError)
    <div class="alert alert-danger" id="success-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{ $catchError }}
    </div>
    @endif

@if($show_table)
    @include('livewire.Parent_Table')
  @else
     <div class="stepwizard">
       
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button"
                   class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                <p>{{ trans('Parent_trans.Step1') }}</p>
            </div>
            <hr style="border: 2px solid black; width: 70px; margin: auto;">
            <div class="stepwizard-step">
                <a href="#step-2" type="button"
                   class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                <p>{{ trans('Parent_trans.Step2') }}</p>
            </div>
            <hr style="border: 2px solid black; width: 70px; margin: auto;">
            <div class="stepwizard-step">
                <a href="#step-3" type="button"
                   class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                   disabled="disabled">3</a>
                <p>{{ trans('Parent_trans.Step3') }}</p>
            </div>
        </div>
    </div>

    @include('livewire.Father_Form')

    @include('livewire.Mother_Form')

    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        @if ($currentStep != 3)
            <div style="display: none" class="row setup-content" id="step-3">
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12 form-submit"><br>
                        <h1 class="Attachments">{{trans('Parent_trans.Attachments')}}</h1>
                        <br>
                        <br>
            @if ($updateMode && $photos)
                <div>
                    <h3>Existing Photos:</h3>
                    <div class="row">
                        @foreach ($photos as $photo)
                            <div class="col-md-3">
                                <div class="card mb-3">
                                    <img class="card-img-top" src="{{ asset($photo['url'])  }}" style="max-width: 200px; max-height: 200px;">
                                                              
                                    <div class="card-body">
                                        <p class="card-text">{{ $photo['file_name'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <br>
            @endif
                        <div class="form-group">
                            <input type="file" wire:model="photos" accept="image/*" multiple>
                        </div>
                        
                        <br>

                        <input type="hidden" wire:model="Parent_id">

                        <button class="btn btn-danger btn-sm nextBtn btn-lg pull-inline-start p-2 ml-1" type="button"
                                wire:click="back(2)">{{ trans('Parent_trans.Back') }}</button>

                        @if($updateMode)
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-inline-start p-2 ml-1" wire:click="submitForm_edit"
                                    type="button">{{trans('Parent_trans.Finish')}}
                            </button>
                        @else
                            <button class="btn btn-success btn-sm btn-lg pull-inline-start p-2 ml-1" wire:click="submitForm"
                                    type="button">{{ trans('Parent_trans.Finish') }}</button>
                        @endif

                    </div>
                </div>
            </div>
            @endif

    </div>

