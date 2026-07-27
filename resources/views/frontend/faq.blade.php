<x-layouts.app :title="'FAQ - Pertanyaan Umum'" :description="'Temukan jawaban atas pertanyaan yang sering diajukan seputar produk dan layanan kami.'">
    <div class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
        <x-section-heading title="Pertanyaan Umum" subtitle="Temukan jawaban atas pertanyaan yang sering diajukan" />

        <div class="mt-10 space-y-8" x-data="{ openIndex: null }">
            @forelse($faqs as $category => $items)
                <div>
                    @if($category)
                        <h2 class="mb-3 font-display font-semibold text-wood-600">{{ $category }}</h2>
                    @endif
                    <div class="space-y-3">
                        @foreach($items as $faq)
                            @php $uid = $loop->parent->index . '-' . $loop->index; @endphp
                            <div class="glass-card overflow-hidden">
                                <button @click="openIndex = openIndex === '{{ $uid }}' ? null : '{{ $uid }}'" class="flex w-full items-center justify-between p-5 text-left font-medium text-brown-800">
                                    {{ $faq->question }}
                                    <svg class="h-5 w-5 shrink-0 transition" :class="openIndex === '{{ $uid }}' ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div x-show="openIndex === '{{ $uid }}'" x-collapse class="px-5 pb-5 text-sm text-brown-800/70">{{ $faq->answer }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="glass-card p-10 text-center text-brown-800/60">Belum ada FAQ tersedia.</div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
