<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Onderwerp bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <form action="{{ route('admin.menu.postUpdate', $subject) }}" method="POST">
                    <div class="col-span-1">
                        <label>Naam</label>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control w-full"
                                   @if(old('name') != null)
                                   value="{{ old('name') }}"
                                   @else
                                   value="{{ $subject->name }}"
                                @endif>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <label>Domein id</label>
                        <div class="form-group">
                            <input type="number" name="domainId" class="form-control w-full"
                                   @if(old('domain_id') != null)
                                   value="{{ old('domain_id') }}"
                                   @else
                                   value="{{ $subject->domain_id }}"
                                @endif>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <label>Order</label>
                        <div class="form-group">
                            <input type="number" name="order" class="form-control w-full"
                                   @if(old('order') != null)
                                   value="{{ old('order') }}"
                                   @else
                                   value="{{ $subject->order }}"
                                @endif>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
