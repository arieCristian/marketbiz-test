<?php

namespace App\Http\Livewire;

use App\Models\Person as ModelsPerson;
use Livewire\Component;
use Livewire\WithPagination;

class Person extends Component
{
    use WithPagination ;
    protected $listeners = ['destroyPerson','cencelDelete'];
    protected $paginationTheme = 'bootstrap';
    public $orderBy,$asc,$search,$age ;
    public $name,$job,$dob ;
    public $person_id ;
    public $showPerson,$weekStatus,$dayStatus ;
    public function mount(){
        $this->orderBy = 'created_at';
        $this->asc = 'desc';
        $this->search = '';
        $this->age = 0 ;
        $this->showPerson = ModelsPerson::first();
        $this->weekStatus = "Belum Diketahui";
        $this->dayStatus = "Belum Diketahui";
    }
    protected $rules = [
        'name' => 'required',
        'job' => 'required',
        'dob' => 'required'
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function resetFields(){
        $this->name = '';
        $this->job = '';
        $this->dob = null ;
        $this->orderBy = 'created_at';
        $this->asc = 'desc';
        $this->search = '';
        $this->age = 0 ;
        $this->weekStatus = "Belum Diketahui";
        $this->dayStatus = "Belum Diketahui";
    }

    public function closeModal(){
        $this->resetFields();
    }
 
    public function addPerson(){
        $validatedData = $this->validate();
        ModelsPerson::create($validatedData);
        $this->resetFields();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('success-add');
    }

    public function showPerson($id){
        $this->showPerson = ModelsPerson::findOrFail($id);
        // $weekDob = date("W", strtotime($this->showPerson->dob)); 
        // if ($weekDob % 2 == 0) {
        //     $this->weekStatus = "Minggu Genap";
        // } else {
        //     $this->weekStatus = "Minggu Ganjil";
        // }
        $weekDob = date("Y-m-d", strtotime($this->showPerson->dob)); 
        $weekDob = intval($this->getWeeks($weekDob, "sunday"));
        if ($weekDob % 2 == 0) {
            $this->weekStatus = "Minggu Genap";
        } else {
            $this->weekStatus = "Minggu Ganjil";
        }
        $dayDob = date("d", strtotime($this->showPerson->dob)); 
        $dayDob = intval($dayDob);
        if ($dayDob % 2 == 0) {
            $this->dayStatus = "Tanggal Genap";
        } else {
            $this->dayStatus = "Tanggal Ganjil";
        }
        $this->dispatchBrowserEvent('open-show-modal');
    }

    public function editPerson($id){
        $person = ModelsPerson::find($id);
        if($person){
            $this->person_id = $person->id;
            $this->name = $person->name;
            $this->job = $person->job;
            $this->dob = date('Y-m-d', strtotime($person->dob));
            $this->dispatchBrowserEvent('open-edit-modal');
        }else{
            return redirect()->to('/');
        }
    }
    public function updatePerson()
    {
        $validatedData = $this->validate();
        ModelsPerson::where('id',$this->person_id)
        ->update([
            'name' => $validatedData['name'],
            'job' => $validatedData['job'],
            'dob' => $validatedData['dob']
        ]);
        $this->dispatchBrowserEvent('close-edit-modal');
        $this->resetFields();
        $this->dispatchBrowserEvent('success-updated');
    }

    public function deletePerson($id)
    {
        $person = ModelsPerson::find($id);
        $this->person_id = $id;
        $this->dispatchBrowserEvent('deleted-confirm',[
            'name' => $person->name
        ]);
    }

    public function destroyPerson()
    {
        ModelsPerson::destroy($this->person_id);
        $this->resetFields();
        $this->dispatchBrowserEvent('deleted-success');
    }

    public function cencelDelete(){
        $this->resetFields();
    }

    function getWeeks($date, $rollover)
    {
        $cut = substr($date, 0, 8);
        $daylen = 86400;

        $timestamp = strtotime($date);
        $first = strtotime($cut . "00");
        $elapsed = ($timestamp - $first) / $daylen;

        $weeks = 1;

        for ($i = 1; $i <= $elapsed; $i++)
        {
            $dayfind = $cut . (strlen($i) < 2 ? '0' . $i : $i);
            $daytimestamp = strtotime($dayfind);

            $day = strtolower(date("l", $daytimestamp));

            if($day == strtolower($rollover))  $weeks ++;
        }

        return $weeks;
    }

    public function render()
    {       
        $people = ModelsPerson::where('name','like','%'.$this->search.'%')
        ->whereRaw('TIMESTAMPDIFF(YEAR, dob, CURDATE()) >= ?', [$this->age])
        ->orderBy($this->orderBy,$this->asc)
        ->paginate(10);
        return view('livewire.person',compact('people'));
    }
}
