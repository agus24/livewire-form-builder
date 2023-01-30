# USAGE

```php
public function mount()
{
    $this->formBuilder = FormBuilder::add(
        type: 'password',
        label: "Old Password",
        model: 'old_password',
        class: "form-control"
    )->add(
        type: 'password',
        label: "New Password",
        model: 'new_password',
        class: "form-control"
    )->add(
        type: 'password',
        label: "Re-type Password",
        model: "confim_password",
        class: "form-control",
    )->getFields();
}
```

then your view
```php
  @livewire('form-builder', [
    "formBuilder" => $formBuilder,
    "rules" => [...], // fill your validation rules
    "message" => [...]] // fill your custom message if you want
  )
```
