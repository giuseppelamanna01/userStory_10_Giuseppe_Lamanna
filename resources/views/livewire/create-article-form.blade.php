<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">

            @if($showSuccess)
                <div class="alert alert-success text-center">
                    Articolo creato correttamente
                </div>
            @endif

            <form wire:submit.prevent="store">
                <div class="mb-3">
                    <label>Titolo</label>
                    <input type="text" wire:model.blur="title" class="form-control">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Descrizione</label>
                    <textarea wire:model.blur="description" class="form-control"></textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Prezzo</label>
                    <input type="number" step="0.01" wire:model.blur="price" class="form-control">
                    @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Categoria</label>
                    <select wire:model.blur="category" class="form-control">
                        <option value="">Seleziona una categoria</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <button type="submit" class="btn btn-dark">Crea</button>
            </form>

        </div>
    </div>
</div>