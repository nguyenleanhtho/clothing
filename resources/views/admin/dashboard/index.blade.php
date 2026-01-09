<x-app-layout>
<div class="space-y-16">

    {{-- STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        @php
            $cards = [
                ['label'=>'Doanh thu thuần','val'=>number_format($stats['revenue']).' đ','icon'=>'💰','sub'=>'Tăng 12% so với tháng trước'],
                ['label'=>'Đơn hàng mới','val'=>$stats['orders'],'icon'=>'📦','sub'=>'Cần xử lý: 3 đơn'],
                ['label'=>'Sản phẩm kho','val'=>$stats['products'],'icon'=>'👕','sub'=>'Hết hàng: 2 mã'],
                ['label'=>'Lượng tồn kho','val'=>$stats['inventory'],'icon'=>'📉','sub'=>'Giá trị: ~2.4 tỷ'],
            ];
        @endphp

        @foreach ($cards as $c)
        <div class="bg-white p-10 rounded-[2.5rem] border shadow-sm hover:shadow-2xl transition">
            <div class="w-16 h-16 bg-zinc-50 rounded-3xl flex items-center justify-center text-3xl mb-8">
                {{ $c['icon'] }}
            </div>
            <p class="text-[10px] font-black uppercase tracking-widest text-zinc-400">{{ $c['label'] }}</p>
            <p class="text-3xl font-black">{{ $c['val'] }}</p>
            <p class="text-[10px] text-zinc-300 font-bold">{{ $c['sub'] }}</p>
        </div>
        @endforeach
    </div>

</div>
</x-app-layout>
