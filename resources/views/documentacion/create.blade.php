@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body p-0">
                    <!-- Contenido del formulario -->
                    <div class="p-4">
                        <h2 class="card-title mb-4">Agregar Documento</h2>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <select class="form-select" id="nombre" name="nombre">
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria }}" {{ old('nombre') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3" id="otroNombreDiv" style="{{ old('nombre') == 'otro' ? 'display: block;' : 'display: none;' }}">
                                <label for="otroNombre" class="form-label">Especificar otro nombre</label>
                                <input type="text" class="form-control" id="otroNombre" name="otroNombre" value="{{ old('otroNombre') }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <select class="form-select" id="descripcion" name="descripcion">
                                    @foreach($descripciones as $desc)
                                        <option value="{{ $desc }}" {{ old('descripcion') == $desc ? 'selected' : '' }}>{{ $desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3" id="otraDescripcionDiv" style="{{ old('descripcion') == 'otro' ? 'display: block;' : 'display: none;' }}">
                                <label for="otraDescripcion" class="form-label">Especificar otra descripción</label>
                                <input type="text" class="form-control" id="otraDescripcion" name="otraDescripcion" value="{{ old('otraDescripcion') }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="formato" class="form-label">Formato</label>
                                <input type="text" class="form-control" id="formato" name="formato" value="{{ old('formato', 'pdf') }}">
                            </div>
                            
                            <div class="mb-4">
                                <label for="archivo" class="form-label">Archivo</label>
                                <input type="file" class="form-control" id="archivo" name="archivo" required>
                                <div class="form-text">Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG. Tamaño máximo: 10MB.</div>
                            </div>
                            
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('documentos.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
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
        
        // Verificar estado inicial
        if (nombreSelect.value === 'otro') {
            otroNombreDiv.style.display = 'block';
        }
        
        if (descripcionSelect.value === 'otro') {
            otraDescripcionDiv.style.display = 'block';
        }
    });
</script>
@endsection