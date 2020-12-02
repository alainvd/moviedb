{{--<div--}}
{{--    x-data--}}
{{--    x-init="() => {--}}
{{--	var choices = new Choices($refs.{{ $attributes['prettyname'] }}, {--}}
{{--		itemSelectText: '',--}}
{{--	});--}}
{{--	choices.passedElement.element.addEventListener(--}}
{{--	  'change',--}}
{{--	  function(event) {--}}
{{--			values = event.detail.value;--}}
{{--		    @this.set('{{ $attributes['wire:model'] }}', values);--}}
{{--	  },--}}
{{--	  false,--}}
{{--	);--}}
{{--	let selected = parseInt(@this.get{!! $attributes['selected'] !!}).toString();--}}
{{--	choices.setChoiceByValue(selected);--}}
{{--	}"--}}
{{-->--}}
{{--    <select id="{{ $attributes['prettyname'] }}" wire-model="{{ $attributes['wire:model'] }}" wire:change="{{ $attributes['wire:change'] }}" x-ref="{{ $attributes['prettyname'] }}">--}}
{{--        <option value="">{{ isset($attributes['placeholder']) ? $attributes['placeholder'] : '-- Select --' }}</option>--}}
{{--        @if(count($attributes['options'])>0)--}}
{{--            @foreach($attributes['options'] as $key=>$option)--}}
{{--                <option value="{{$key}}" >{{$option}}</option>--}}
{{--            @endforeach--}}
{{--        @endif--}}
{{--    </select>--}}
{{--</div>--}}

<div  x-data
      wire:ignore
      x-init="() => {

      var choices = new Choices($refs.mySelect, {
          removeItemButton: true,
          choices: {{ $options }}
        }).setChoices(
          [
            { value: 'Four', label: 'Label Four', disabled: true },
            { value: 'Five', label: 'Label Five' },
            { value: 'Six', label: 'Label Six', selected: true },
            { value: 'Seven', label: 'Label Seven', selected: true },
          ],
          'value',
          'label',
          false
);

	choices.passedElement.element.addEventListener(
	  'addItem',
	  function(event) {

	  Livewire.emit('addItem', event.detail.value)

	  },
	  false,
	);

	choices.passedElement.element.addEventListener(
	  'removeItem',
	  function(event) {

	  Livewire.emit('removeItem', event.detail.value)

	  },
	  false,
	);






};




">
    <select multiple id="mySelect" x-ref="mySelect"
            name="email"
            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
            placeholder="you@example.com"
    >
    </select>
</div>
