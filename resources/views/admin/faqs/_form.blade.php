@php $faq = $faq ?? null; @endphp
<div>
    <label class="text-sm font-medium text-brown-800">Pertanyaan</label>
    <input type="text" name="question" value="{{ old('question', $faq->question ?? '') }}" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
</div>
<div>
    <label class="text-sm font-medium text-brown-800">Jawaban</label>
    <textarea name="answer" rows="4" required class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">{{ old('answer', $faq->answer ?? '') }}</textarea>
</div>
<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
    <div>
        <label class="text-sm font-medium text-brown-800">Kategori (opsional)</label>
        <input type="text" name="category" value="{{ old('category', $faq->category ?? '') }}" placeholder="cth: Produk, Pengiriman" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div>
        <label class="text-sm font-medium text-brown-800">Urutan</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}" class="mt-1 w-full rounded-xl border border-wood-400/20 bg-white/70 px-4 py-2.5 text-sm">
    </div>
    <div class="flex items-end pb-2">
        <label class="flex items-center gap-2 text-sm font-medium text-brown-800">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $faq->is_active ?? true)) class="rounded border-wood-400/30">
            Tampilkan
        </label>
    </div>
</div>
