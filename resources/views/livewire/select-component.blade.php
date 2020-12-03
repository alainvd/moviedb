<div  x-data
      wire:ignore
      x-init="() => {

      var choices = new Choices($refs.mySelect, {
          removeItemButton: true,
          choices: {{ $options }}
        });

	choices.passedElement.element.addEventListener(
	  'addItem',
	  function(event) {

	  Livewire.emit('addItem', ['{{$name}}',event.detail])

	  },
	  false,
	);

	choices.passedElement.element.addEventListener(
	  'removeItem',
	  function(event) {

	  Livewire.emit('removeItem', ['{{$name}}',event.detail])

	  },
	  false,
	);


};




">
    <select multiple id="mySelect" x-ref="mySelect"

>
    </select>


</div>
