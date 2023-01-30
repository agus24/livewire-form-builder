<?php
namespace Gustiawan\LivewireFormBuilder\livewire;

use Livewire\Component;
use Gustiawan\LivewireFormBuilder\FormBuilder;

class FormBuilderComponent extends Component
{
    public $formBuilder;
    public $form = [];
    public $ruleList = [];
    public $messageList = [];

    public function mount(array $formBuilder, array $rules = [], array $messages = [])
    {
        $this->formBuilder = $formBuilder;

        $this->ruleList = $this->addFormCustomKey($rules);
        $this->messageList = $this->addFormCustomKey($messages);
    }

    private function addFormCustomKey($bag)
    {
        foreach ($bag as $key => $content) {
            $bag["form.".$key] = $content;
            unset($bag[$key]);
        }

        return $bag;
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
        $this->validate($this->ruleList);
        $this->emit('submit', $this->form);
    }

    public function render()
    {
        return view('livewire-form-builder::form-builder');
    }
}
