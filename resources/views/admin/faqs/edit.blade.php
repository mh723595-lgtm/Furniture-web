<x-layouts.admin title="Edit FAQ">
    <div class="glass-card mx-auto max-w-2xl p-6">
        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" class="space-y-4">
            @csrf @method('PUT')
            @include('admin.faqs._form')
            <button type="submit" class="btn-primary w-full">Perbarui FAQ</button>
        </form>
    </div>
</x-layouts.admin>
