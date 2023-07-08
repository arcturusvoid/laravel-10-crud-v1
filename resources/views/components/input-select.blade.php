<select {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
    @forelse ($options as $ticket_category)
        <option value="{{ $ticket_category->id }}" {{$ticket_category->id === $oldvalueindex? "selected=true" : ''}}>
            {{ $ticket_category->name }}</option>
    @empty
        <option selected>No Category</option>
    @endforelse
</select>