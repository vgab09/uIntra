<?php
/**
 * Created by PhpStorm.
 * User: g09
 * Date: 2018.12.08.
 * Time: 17:49
 */

namespace App\Http\Components\FormHelper;

use Collective\Html\FormFacade as Form;

class FormFieldHelper
{
    /**
     * @var string Theoretically optional, but in reality each field has to have a label
     */
    protected $label;

    /**
     * @var string the name of the model attribute from which we get the value
     */
    protected $name;

    /**
     * @var string input type: text, password, range, hidden, search, tel, email, number, date, datetime,
     * datetimeLocal, time, url, week, file, textarea, select, selectRange, selectYear, selectMonth, checkbox, radio, image, month color, submit
     */
    protected $type;
    // custom: select,selectMonth ,
    // custom: selectRange, selectYear

    // custom radio: checkbox ,checkbox
    // custom button: button

    public const TEXT_TYPE = 'text';
    public const EMAIL_TYPE = 'email';
    public const PASSWORD_TYPE = 'password';
    public const SELECT_TYPE = 'select';
    public const TEXTAREA_TYPE = 'textarea';
    public const RADIO_TYPE = 'radio';
    public const CHECKBOX_TYPE = 'checkbox';
    public const FILE_TYPE = 'file';
    public const COLOR_TYPE = 'color';
    public const NUMBER_TYPE = 'number';
    public const DATE_TYPE = 'date';

    /**
     * @var bool If true, it will be required item. The label will append by a star
     */
    protected $required = false;

    /**
     * @var string The description displayed under the field.
     */
    protected $description;

    /**
     * @var string This is displayed when the mouse hovers the field.
     */
    protected $hint;

    /**
     * @var string This is displayed after the field (ie. to indicate the unit of measure)
     */
    protected $suffix;

    /**
     * @var string input placeholder text. To be displayed when the field is empty
     */
    protected $placeholder;

    /**
     * @var int Textural input field max lenght
     */
    protected $maxLength;

    /**
     * @var bool disable edit
     */
    protected $disabled = false;

    /**
     * @var mixed|null field value
     */
    protected $value = null;

    /**
     * @var string|null fontAwesome icon full class
     */
    protected $iconClass = null;

    /**
     * @var array field error messages
     */
    protected $errors = [];

    /**
     * FormFieldHelper constructor.
     * @param $name string Field name
     * @param $type string Field Type
     * @param string $label Field label
     */
    public function __construct($name, $type, $label = '')
    {
        $this->setName($name);
        $this->setType($type);
        $this->setLabel($label);
    }

    /**
     * Create new FormFieldHelper instance
     * @param string $name
     * @param string $type
     * @param string $label
     * @return FormFieldHelper
     */
    public static function to(string $name, string $type, string $label){
        return new static($name,$type,$label);
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return FormFieldHelper
     */
    public function setLabel(string $label): FormFieldHelper
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return FormFieldHelper
     */
    public function setName(string $name): FormFieldHelper
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return FormFieldHelper
     */
    public function setType(string $type): FormFieldHelper
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     * @return FormFieldHelper
     */
    public function setRequired(bool $required): FormFieldHelper
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return FormFieldHelper
     */
    public function setDescription(string $description): FormFieldHelper
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getHint(): string
    {
        return $this->hint;
    }

    /**
     * @param string $hint
     * @return FormFieldHelper
     */
    public function setHint(string $hint): FormFieldHelper
    {
        $this->hint = $hint;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuffix(): string
    {
        return $this->suffix;
    }

    /**
     * @param string $suffix
     * @return FormFieldHelper
     */
    public function setSuffix(string $suffix): FormFieldHelper
    {
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }

    /**
     * @param string $placeholder
     * @return FormFieldHelper
     */
    public function setPlaceholder(string $placeholder): FormFieldHelper
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxLength(): int
    {
        return $this->maxLength;
    }

    /**
     * @param int $maxLength
     * @return FormFieldHelper
     */
    public function setMaxLength(int $maxLength): FormFieldHelper
    {
        $this->maxLength = $maxLength;
        return $this;
    }

    /**
     * return true if field is disabled
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     * @return FormFieldHelper
     */
    public function setDisabled(bool $disabled): FormFieldHelper
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getValue(): ?mixed
    {
        return $this->value;
    }

    /**
     * @param mixed|null $value
     * @return FormFieldHelper
     */
    public function setValue(?mixed $value): FormFieldHelper
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getIconClass(): ?string
    {
        return $this->iconClass;
    }

    public function hasIcon(){
        return !empty($this->iconClass);
    }

    /**
     * @param null|string $iconClass
     * @return FormFieldHelper
     */
    public function setIconClass(?string $iconClass): FormFieldHelper
    {
        $this->iconClass = $iconClass;
        return $this;
    }



    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     * @return FormFieldHelper
     */
    public function setErrors(array $errors): FormFieldHelper
    {
        $this->errors = $errors;
        return $this;
    }

    public function render(){
        return Form::inputWithLabel($this);
    }

}