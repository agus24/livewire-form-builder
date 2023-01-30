<?php
namespace Gustiawan\LivewireFormBuilder\Traits;

trait UseFormBuilder
{
    public $formBuilder;
    public $form = [];
    public $ruleList = [];
    public $messageList = [];

    public function mount(array $formBuilder, array $rules = [], array $messages = [])
    {
        $this->formBuilder = $formBuilder;

        $this->ruleList = $rules;
        $this->messageList = $messages;

        $this->parseFormForCheckbox();
    }

    private function parseFormForCheckbox()
    {
        foreach ($this->formBuilder as $builder) {
            if ($builder['type'] == 'check') {
                $this->form[$builder['model']] = [];
            }
        }
    }

    public function messages()
    {
        return $this->messageList;
    }

    public function updated($propertyName)
    {
        if (count($this->ruleList) == 0) {
            return;
        }

        $this->resetErrorBag();

        $this->validateOnly($propertyName, $this->ruleList);
    }

    public function submit()
    {
        if (count($this->ruleList) > 0) {
            $this->validate($this->ruleList);
        }

        $this->emit('submit', $this->form);
    }

    public function render()
    {
        return view('livewire-form-builder::form-builder');
    }
}
