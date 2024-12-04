<?php

namespace App\Livewire;

use App\Models\Company;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\InteractsWithBanner;

class Companies extends Component
{

    use InteractsWithBanner;

    public $companies;
    public $company_id, $name, $address, $inn, $kpp,
        $director, $accountant, $bank_rs, $bank_bik,
        $bank_ks, $bank_name;
    public $editForm = false, $confirmingDeletion = false;
    public $createOrUpdate;

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        $this->companies = Company::all();
        return view('livewire.companies');
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $this->resetInputFields();
        $this->createOrUpdate = 0;
        $this->editForm = true;
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $this->createOrUpdate = 1;

        $company = Company::findOrFail($id);

        $this->company_id = $company->id;
        $this->name = $company->name;
        $this->address = $company->address;
        $this->inn = $company->inn;
        $this->kpp = $company->kpp;
        $this->director = $company->director;
        $this->accountant = $company->accountant;
        $this->bank_rs = $company->bank_rs;
        $this->bank_bik = $company->bank_bik;
        $this->bank_ks = $company->bank_ks;
        $this->bank_name = $company->bank_name;

        $this->editForm = true;
    }

    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'inn' => [
                'required',
                'numeric',
                Rule::unique('companies')->ignore($this->company_id)
            ],
            'kpp' =>
            [
                'nullable',
                'numeric',
                Rule::unique('companies')->ignore($this->company_id)
            ],
            'director' => 'required|string',
            'accountant' => 'nullable|string',
            'bank_rs' => [
                'required',
                'numeric',
                Rule::unique('companies')->ignore($this->company_id)
            ],
            'bank_bik' => [
                'required',
                'numeric',
            ],
            'bank_ks' => [
                'required',
                'numeric',
            ],
            'bank_name' => 'required|string',
        ]);

        Company::updateOrCreate(
            ['id' => $this->company_id],
            [
                'name' => $this->name,
                'address' => $this->address,
                'inn' => $this->inn,
                'kpp' => $this->kpp,
                'director' => $this->director,
                'accountant' => $this->accountant,
                'bank_rs' => $this->bank_rs,
                'bank_bik' => $this->bank_bik,
                'bank_ks' => $this->bank_ks,
                'bank_name' => $this->bank_name,
            ]
        );

        $this->banner('Updated Successfully.');
        $this->editForm = false;
        $this->resetInputFields();
    }

    /**
     * confirmDelete
     *
     * @param  mixed $id
     * @return void
     */
    public function confirmDelete($id)
    {
        $this->company_id = $id;
        $this->confirmingDeletion = true;
    }

    /**
     * delete
     *
     * @return void
     */
    public function delete()
    {
        Company::find($this->company_id)->delete();
        $this->dangerBanner('Record deleted.');
        $this->confirmingDeletion = false;
    }

    /**
     * resetInputFields
     *
     * @return void
     */
    private function resetInputFields()
    {
        $this->company_id = '';
        $this->name = '';
        $this->address = '';
        $this->inn = '';
        $this->kpp = '';
        $this->director = '';
        $this->accountant = '';
        $this->bank_rs = '';
        $this->bank_bik = '';
        $this->bank_ks = '';
        $this->bank_name = '';
    }
}
