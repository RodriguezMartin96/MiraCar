@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body p-0">
                    <!-- Contenido del formulario -->
                    <div class="p-4">
                        <h2 class="card-title mb-4">Editar Documento</h2>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form action="{{ route('documentos.update', $documento) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <select class="form-select" id="nombre" name="nombre">
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria }}" {{ old('nombre', $documento->nombre) == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3" id="otroNombreDiv" style="{{ old('nombre', $documento->nombre) == 'otro' ? 'display: block;' : 'display: none;' }}">
                                <label for="otroNombre" class="form-label">Especificar otro nombre</label>
                                <input type="text" class="form-control" id="otroNombre" name="otroNombre" value="{{ old('otroNombre', $documento->otro_nombre) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <select class="form-select" id="descripcion" name="descripcion">
                                    @foreach($descripciones as $desc)
                                        <option value="{{ $desc }}" {{ old('descripcion', $documento->descripcion) == $desc ? 'selected' : '' }}>{{ $desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3" id="otraDescripcionDiv" style="{{ old('descripcion', $documento->descripcion) == 'otro' ? 'display: block;' : 'display: none;' }}">
                                <label for="otraDescripcion" class="form-label">Especificar otra descripción</label>
                                <input type="text" class="form-control" id="otraDescripcion" name="otraDescripcion" value="{{ old('otraDescripcion', $documento->otra_descripcion) }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="formato" class="form-label">Formato</label>
                                <input type="text" class="form-control" id="formato" name="formato" value="{{ old('formato', $documento->formato) }}">
                            </div>
                            
                            <div class="mb-4">
                                <label for="archivo" class="form-label">Archivo</label>
                                
                                @if($documento->ruta_archivo)
                                    <div class="current-file d-flex align-items-center">
                                        @php
                                            $extension = pathinfo(storage_path('app/public/' . $documento->ruta_archivo), PATHINFO_EXTENSION);
                                            $iconClass = 'bi-file-earmark';
                                            
                                            if (in_array($extension, ['pdf'])) {
                                                $iconClass = 'bi-file-earmark-pdf';
                                            } elseif (in_array($extension, ['doc', 'docx'])) {
                                                $iconClass = 'bi-file-earmark-word';
                                            } elseif (in_array($extension, ['xls', 'xlsx'])) {
                                                $iconClass = 'bi-file-earmark-excel';
                                            } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                                $iconClass = 'bi-file-earmark-image';
                                            }
                                        @endphp
                                        
                                        <i class="bi {{ $iconClass }} file-icon"></i>
                                        <span>{{ basename($documento->ruta_archivo) }}</span>
                                    </div>
                                @endif
                                
                                <input type="file" class="form-control" id="archivo" name="archivo">
                                <div class="form-text">
                                    @if($documento->ruta_archivo)
                                        Sube un nuevo archivo para reemplazar el actual, o deja este campo vacío para mantener el archivo actual.
                                    @else
                                        Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG. Tamaño máximo: 10MB.
                                    @endif
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('documentos.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Script para mostrar/ocultar campos adicionales
    document.addEventListener('DOMContentLoaded', function() {
        const nombreSelect = document.getElementById('nombre');
        const otroNombreDiv = document.getElementById('otroNombreDiv');
        const otroNombreInput = document.getElementById('otroNombre');
        const descripcionSelect = document.getElementById('descripcion');
        const otraDescripcionDiv = document.getElementById('otraDescripcionDiv');
        const otraDescripcionInput = document.getElementById('otraDescripcion');
        
        nombreSelect.addEventListener('change', function() {
            if (this.value === 'otro') {
                otroNombreDiv.style.display = 'block';
                otroNombreInput.focus();
            } else {
                otroNombreDiv.style.display = 'none';
            }
        });
        
        descripcionSelect.addEventListener('change', function() {
            if (this.value === 'otro') {
                otraDescripcionDiv.style.display = 'block';
                otraDescripcionInput.focus();
            } else {
                otraDescripcionDiv.style.display = 'none';
            }
        });
    });
</script>
@endsection