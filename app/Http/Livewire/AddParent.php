<?php

namespace App\Http\Livewire;

use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Religion;
use App\Models\Type_Blood;
use App\Models\ParentAttachment;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AddParent extends Component
{
    use WithFileUploads;
    public $successMessage = '';

    public $catchError,$updateMode = false,$photos,$show_table=true,$Parent_id;
   public $currentStep = 1,


        // Father_INPUTS
        $Email, $Password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Address_Father_en, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Address_Mother_en, $Religion_Mother_id;


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'Password' =>'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]/|min:4',
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }


    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Nationalitie::all(),
            'Type_Bloods' => Type_Blood::all(),
            'Religions' => Religion::all(),
            'my_parents' => My_Parent::all(),
        ]);

    }

    //firstStepSubmit
    public function firstStepSubmit()
    {
       $this->validate([
            'Email' => 'required|unique:my__parents,Email,'.$this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my__parents,National_ID_Father|unique:my__parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my__parents,Passport_ID_Father|unique:my__parents,Passport_ID_Mother,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
            'Address_Father_en' => 'required',

        ]);

        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {

        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my__parents,National_ID_Mother|unique:my__parents,National_ID_Father,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my__parents,Passport_ID_Mother|unique:my__parents,Passport_ID_Father,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
            'Address_Mother_en' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function submitForm(){

        try {
            $My_Parent = new My_Parent();
            // Father_INPUTS
            $My_Parent->Email = $this->Email;
            $My_Parent->Password = Hash::make($this->Password);
            $My_Parent->Name_Father = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
            $My_Parent->National_ID_Father = $this->National_ID_Father;
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Phone_Father = $this->Phone_Father;
            $My_Parent->Job_Father = ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father];
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Nationality_Father_id = $this->Nationality_Father_id;
            $My_Parent->Blood_Type_Father_id = $this->Blood_Type_Father_id;
            $My_Parent->Religion_Father_id = $this->Religion_Father_id;
            $My_Parent->Address_Father = ['en' => $this->Address_Father_en, 'ar' => $this->Address_Father];

            // Mother_INPUTS
            $My_Parent->Name_Mother = ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother];
            $My_Parent->National_ID_Mother = $this->National_ID_Mother;
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Phone_Mother = $this->Phone_Mother;
            $My_Parent->Job_Mother = ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother];
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Nationality_Mother_id = $this->Nationality_Mother_id;
            $My_Parent->Blood_Type_Mother_id = $this->Blood_Type_Mother_id;
            $My_Parent->Religion_Mother_id = $this->Religion_Mother_id;
            $My_Parent->Address_Mother = ['en' => $this->Address_Mother_en, 'ar' => $this->Address_Mother];

            $My_Parent->save();
            if (!empty($this->photos)){
                foreach ($this->photos as $photo) {
                    //  هات الاسم التابع لها -2 National_ID_Fatherافتح ملف باسم -1
                    $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        // هات اخر id بعد عمليه save
                        'parent_id' => My_Parent::latest()->first()->id,
                    ]);
                }
            }
           
            toastr()->success(trans('messages.success'));
            return redirect()->to('/add_parent');
            // $this->successMessage = trans('messages.success');
            // $this->show_table = true;
            // $this->clearForm();
            // $this->currentStep = 1;
        }

        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };



    }

    //clearForm
    // public function clearForm()
    // {
    //     $this->Email = '';
    //     $this->Password = '';
    //     $this->Name_Father = '';
    //     $this->Job_Father = '';
    //     $this->Job_Father_en = '';
    //     $this->Name_Father_en = '';
    //     $this->National_ID_Father ='';
    //     $this->Passport_ID_Father = '';
    //     $this->Phone_Father = '';
    //     $this->Nationality_Father_id = '';
    //     $this->Blood_Type_Father_id = '';
    //     $this->Address_Father ='';
    //     $this->Religion_Father_id ='';

    //     $this->Name_Mother = '';
    //     $this->Job_Mother = '';
    //     $this->Job_Mother_en = '';
    //     $this->Name_Mother_en = '';
    //     $this->National_ID_Mother ='';
    //     $this->Passport_ID_Mother = '';
    //     $this->Phone_Mother = '';
    //     $this->Nationality_Mother_id = '';
    //     $this->Blood_Type_Mother_id = '';
    //     $this->Address_Mother ='';
    //     $this->Religion_Mother_id ='';

    // }

    public function showformadd(){
        $this->show_table = false;
    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $My_Parent = My_Parent::where('id',$id)->first();
        $this->Parent_id = $id;
        $this->Email = $My_Parent->Email;
        $this->Password = $My_Parent->Password;
        $this->Name_Father = $My_Parent->getTranslation('Name_Father', 'ar');
        $this->Name_Father_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Father = $My_Parent->getTranslation('Job_Father', 'ar');;
        $this->Job_Father_en = $My_Parent->getTranslation('Job_Father', 'en');
        $this->National_ID_Father =$My_Parent->National_ID_Father;
        $this->Passport_ID_Father = $My_Parent->Passport_ID_Father;
        $this->Phone_Father = $My_Parent->Phone_Father;
        $this->Nationality_Father_id = $My_Parent->Nationality_Father_id;
        $this->Blood_Type_Father_id = $My_Parent->Blood_Type_Father_id;
        $this->Address_Father = $My_Parent->getTranslation('Address_Father', 'ar');
        $this->Address_Father_en = $My_Parent->getTranslation('Address_Father', 'en');
        $this->Religion_Father_id =$My_Parent->Religion_Father_id;

        $this->Name_Mother = $My_Parent->getTranslation('Name_Mother', 'ar');
        $this->Name_Mother_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Mother = $My_Parent->getTranslation('Job_Mother', 'ar');;
        $this->Job_Mother_en = $My_Parent->getTranslation('Job_Mother', 'en');
        $this->National_ID_Mother =$My_Parent->National_ID_Mother;
        $this->Passport_ID_Mother = $My_Parent->Passport_ID_Mother;
        $this->Phone_Mother = $My_Parent->Phone_Mother;
        $this->Nationality_Mother_id = $My_Parent->Nationality_Mother_id;
        $this->Blood_Type_Mother_id = $My_Parent->Blood_Type_Mother_id;
        $this->Address_Mother = $My_Parent->getTranslation('Address_Mother', 'ar');
        $this->Address_Mother_en = $My_Parent->getTranslation('Address_Mother', 'en');
        $this->Religion_Mother_id =$My_Parent->Religion_Mother_id;
        $attachments = ParentAttachment::where('parent_id', $this->Parent_id)->get();
        $this->photos = [];
        foreach ($attachments as $attachment) {
            $this->photos[] = [
                'file_name' => $attachment->file_name,
                'url' => Storage::disk('parent_attachments')->url($this->National_ID_Father . '/' . $attachment->file_name),  
            ];
        }
        // dd($this->photos); 
    }

    
    //firstStepSubmit
    public function firstStepSubmit_edit()
    {
        // $this->validate([
        //     'National_ID_Father' => [
        //      'required',
        //      'string',
        //      'min:10',
        //      'max:10',
        //      Rule::unique('my__parents', 'National_ID_Father')->ignore($this->Parent_id),
        //      Rule::unique('my__parents', 'National_ID_Mother')->ignore($this->Parent_id),

        //  ],
        //  'Passport_ID_Father' => [
        //      'required',
        //      'string',
        //      'min:10',
        //      'max:10',
        //      Rule::unique('my__parents', 'Passport_ID_Father')->ignore($this->Parent_id),
        //      Rule::unique('my__parents', 'Passport_ID_Mother')->ignore($this->Parent_id),

        //  ],
        //     'Email' => 'required|email|unique:my__parents,Email,' . $this->Parent_id,
        //     'Password' => 'required',
        //     'Name_Father' => 'required',
        //     'Name_Father_en' => 'required',
        //     'Job_Father' => 'required',
        //     'Job_Father_en' => 'required',
        //     'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        //     'Nationality_Father_id' => 'required',
        //     'Blood_Type_Father_id' => 'required',
        //     'Religion_Father_id' => 'required',
        //     'Address_Father' => 'required',
        //     'Address_Father_en' => 'required',
        // ]);
        $this->updateMode = true;
        $this->currentStep = 2;

    }

    //secondStepSubmit_edit
    public function secondStepSubmit_edit()
    {
        // $this->validate([
        // 'National_ID_Mother' => [
        //         'required',
        //         'string',
        //         'min:10',
        //         'max:10',
        //         Rule::unique('my__parents', 'National_ID_Father')->ignore($this->Parent_id),
        //         Rule::unique('my__parents', 'National_ID_Mother')->ignore($this->Parent_id),
        //     ],
        // 'Passport_ID_Mother' => [
        //         'required',
        //         'string',
        //         'min:10',
        //         'max:10',
        //         Rule::unique('my__parents', 'Passport_ID_Father')->ignore($this->Parent_id),
        //         Rule::unique('my__parents', 'Passport_ID_Mother')->ignore($this->Parent_id),
        //     ],
        // 'Name_Mother' => 'required',
        // 'Name_Mother_en' => 'required',
        // 'Job_Mother' => 'required',
        // 'Job_Mother_en' => 'required',
        // 'Phone_Mother' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        // 'Nationality_Mother_id' => 'required',
        // 'Blood_Type_Mother_id' => 'required',
        // 'Religion_Mother_id' => 'required',
        // 'Address_Mother' => 'required',
        // 'Address_Mother_en' => 'required',
        // ]);
        $this->updateMode = true;
        $this->currentStep = 3;

    }

    public function submitForm_edit(){
        if ($this->Parent_id){
            $parent = My_Parent::findOrFail($this->Parent_id);
            $parent->update([
                'Email' => $this->Email,
                'Password' => Hash::make($this->Password),
                'Name_Father' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'Passport_ID_Father' => $this->Passport_ID_Father,
                'National_ID_Father' => $this->National_ID_Father,
                'Phone_Father' => $this->Phone_Father,
                'Job_Father' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
                'Nationality_Father_id' => $this->Nationality_Father_id,
                'Blood_Type_Father_id' => $this->Blood_Type_Father_id,
                'Religion_Father_id' => $this->Religion_Father_id,
                'Address_Father' => ['en' => $this->Address_Father_en, 'ar' => $this->Address_Father],
    
                // Mother_INPUTS
                'Name_Mother' => ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
                'National_ID_Mother' => $this->National_ID_Mother,
                'Passport_ID_Mother' => $this->Passport_ID_Mother,
                'Phone_Mother' => $this->Phone_Mother,
                'Job_Mother' => ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
                'Nationality_Mother_id' => $this->Nationality_Mother_id,
                'Blood_Type_Mother_id' => $this->Blood_Type_Mother_id,
                'Religion_Mother_id' => $this->Religion_Mother_id,
                'Address_Mother' => ['en' => $this->Address_Mother_en, 'ar' => $this->Address_Mother]
            ]);
        // Handle new photo uploads
        // if ($this->photos) {
        //     // Remove old photos if needed
        //     $existingAttachments = ParentAttachment::where('parent_id', $this->Parent_id)->get();
        //     foreach ($existingAttachments as $attachment) {
        //         Storage::disk('parent_attachments')->delete($this->National_ID_Father . '/' . $attachment->file_name);
        //         $attachment->delete();
        //     }

        //     // Save new photos
        //     foreach ($this->photos as $photo) {
        //         //  هات الاسم التابع لها -2 National_ID_Fatherافتح ملف باسم -1
        //         $photo->storeAs($this->National_ID_Father, $photo->getClientOriginalName(), $disk = 'parent_attachments');
        //         ParentAttachment::create([
        //             'file_name' => $photo->getClientOriginalName(),
        //             // هات اخر id بعد عمليه save
        //             'parent_id' => My_Parent::latest()->first()->id,
        //         ]);
        //     }
        // }
            
        if ($this->photos) {
            // Remove old photos if needed
            $existingAttachments = ParentAttachment::where('parent_id', $this->Parent_id)->get();
            foreach ($existingAttachments as $attachment) {
                Storage::disk('parent_attachments')->delete($this->National_ID_Father . '/' . $attachment->file_name);
                $attachment->delete();
            }
        
            // Save new photos
            foreach ($this->photos as $photo) {
                // Check if the photo is valid
                if ($photo->isValid()) {
                    $photoPath = $this->National_ID_Father . '/' . $photo->getClientOriginalName();
                    // Store the photo
                    Storage::disk('parent_attachments')->put($photoPath, file_get_contents($photo->getRealPath()));
        
                    // Create a new attachment record
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => $this->Parent_id,
                    ]);
                }
            }
        }
        
        }
        toastr()->success(trans('messages.Update'));
        return redirect()->to('/add_parent');
        // $this->successMessage = trans('messages.Update');

    }


    public function delete($id){
        My_Parent::findOrFail($id)->delete();
        toastr()->error(trans('messages.Delete'));
        // $this->successMessage = trans('messages.Delete');
        return redirect()->to('/add_parent');
    }
   

    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }

}