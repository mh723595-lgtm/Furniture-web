<x-layouts.admin title="Edit Testimoni">
    <div class="glass-card mx-auto max-w-2xl p-6">
        <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            @include('admin.testimonials._form')
            <button type="submit" class="btn-primary w-full">Perbarui Testimoni</button>
        </form>
    </div>
</x-layouts.admin>
