@extends('layouts.app')
@section('title', 'Modifier un vin au cellier')
@section('content')

<section class="mb-lg">
    <div class="mx-auto max-w-3xl my-md">
        <a href="{{ route('cellar_bottle.show', $cellarBottle->id) }}">
            <article class="flex max-w-full min-h-full flex-col items-start justify-between border border-light-gray/30 rounded-md p-sm hover:border-light-gray/60 transition duration-300 ease-in-out">
                <figure class="flex flex-col gap-md sm:flex-row gap-x-sm xs:gap-x-xxs s:gap-x-sm">
                    @if($cellarBottle->bottle->is_custom)
                    <img src="{{  asset($cellarBottle->bottle->image)  }}" alt="Bouteille personnalisée" class="max-w-[111px] max-h-[166px] object-cover mx-auto">
                    @else
                    <img src="{{$cellarBottle->bottle->image}}" alt="{{$cellarBottle->bottle->name}}" class="max-w-[111px] max-h-[166px] object-cover mx-auto">
                    @endif
                    <figcaption class="flex flex-col gap-xxs flex-wrap">
                        <div>
                            <header>
                                <h2 class="xs:text-base sm:text-md md:text-lg uppercase">{{$cellarBottle->bottle->name}}</h2>
                            </header>
                            <div class="flex gap-xs flex-wrap">
                                <p>{{$cellarBottle->bottle->type}}</p>
                                <div class="border-2 border-l border-light-gray"></div>
                                <p>{{$cellarBottle->bottle->format}}</p>
                                <div class="border-2 border-l border-light-gray"></div>
                                <p>{{$cellarBottle->bottle->country}}</p>
                            </div>
                        </div>
                    </figcaption>
                </figure>
            </article>
        </a>
    </div>
    <form method="POST" class="flex flex-col gap-sm md:max-w-3xl mx-auto">
        @csrf
        @method('PUT')
        <div class="hidden flex flex-col gap-xxs">
            <label for="cellar_name">Nom du cellier</label>
            <select class="border border-light-gray/30 rounded-md p-xs" required name="cellar_id" id="cellar_name">
                <option value="">Sélectionner un cellier</option>
                @foreach ($cellars as $cellar)
                <option value="{{ $cellar->id }}"
                    @if($cellarBottle->cellar_id == $cellar->id)
                    selected
                    @endif>
                    {{ $cellar->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class=" flex flex-col gap-xxs">
            <label for="purchase_date">Date d'achat</label>
            <input type="date" id="purchase_date" name="purchase_date" value="{{ old('purchase_date', $cellarBottle->purchase_date ?? $cellarBottle->created_at->format('Y-m-d')) }}" class="border border-light-gray/30 rounded-md p-xs">
            @if($errors->has('purchase_date'))
            <div class="border border-alert text-alert rounded-md p-xxs">
                {{$errors->first('purchase_date')}}
            </div>
            @endif
        </div>

        <div class="flex flex-col gap-xxs">
            <label for="storage_until">Garder jusqu'à</label>
            <input type="date" id="storage_until" name="storage_until" value="{{ old('storage_until', $cellarBottle->storage_until) }}" class="border border-light-gray/30 rounded-md p-xs">
            @if($errors->has('storage_until'))
            <div class="border border-alert text-alert rounded-md p-xxs">
                {{$errors->first('storage_until')}}
            </div>
            @endif
        </div>

        <div class="flex flex-col gap-xxs">
            <label for="price">Prix</label>
            <input type="number" id="price" name="price" step="0.01"
                value="{{ old('price', number_format($cellarBottle->bottle->price, 2, '.', '')) }}"
                placeholder="Prix" aria-label="Prix" class="border border-light-gray/30 rounded-md p-xs">
            @if($errors->has('price'))
            <div class="border border-alert text-alert rounded-md p-xxs">
                {{$errors->first('price')}}
            </div>
            @endif
        </div>

        <div class="flex flex-col gap-xxs">
            <label for="quantity">Quantité</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $cellarBottle->quantity) }}" placeholder="Quantité" aria-label="Quantité" class="border border-light-gray/30 rounded-md p-xs">
            @if($errors->has('quantity'))
            <div class="border border-alert text-alert rounded-md p-xxs">
                {{$errors->first('quantity')}}
            </div>
            @endif
        </div>

        <div class="flex flex-col gap-xxs">
            <label for="vintage">Millésime</label>
            <input type="number" id="vintage" name="vintage" value="{{ old('vintage', $cellarBottle->vintage) }}" placeholder="Millésime" aria-label="Millésime" class="border border-light-gray/30 rounded-md p-xs">
            @if($errors->has('vintage'))
            <div class="border border-alert text-alert rounded-md p-xxs">
                {{$errors->first('vintage')}}
            </div>
            @endif
        </div>

        <div class="flex flex-col gap-xxs">
            <label for="notes">Notes</label>
            <textarea id="notes" name="notes" placeholder="Notes" aria-label="Notes" class="border border-light-gray/30 rounded-md p-xs">{{ old('notes', $cellarBottle->notes) }}</textarea>
            @if($errors->has('notes'))
            <div class="border border-alert text-alert rounded-md p-xxs">
                {{$errors->first('notes')}}
            </div>
            @endif
        </div>

        <!-- Champ caché pour maintenir la relation bottle_id -->
        <input type="hidden" name="bottle_id" value="{{ $cellarBottle->bottle_id }}">

        <button type="submit" class="bouton mt-0">Sauvegarder</button>

        <div class="text-center mt-sm">
            <a href="{{ route('cellar_bottle.show', $cellarBottle->id ) }}" class="link-underline-hover">Annuler</a>
        </div>
    </form>
</section>

@endsection