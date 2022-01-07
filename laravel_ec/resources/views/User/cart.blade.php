<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($products)>0)
                    @foreach ($products as $product )
                    <div class="md:flex md:items-center mb-2">
                        <div class="md:w-3/12">
                            @if ($product->ImageFirst->filename!==null)
                            <img src="{{ asset('storage/products/'.$product->imageFirst->filename) }}" alt="">
                            @else
                            <img src="" alt="">
                            @endif
                        </div>
                        <div class="md:w-4/12">{{ $product->name }}</div>
                        <div class="md:w-3/12 flex justfy-around">
                            <div class="mr-8">{{ $product->pivot->quantity}}個
                            </div>
                            <div>{{ number_format($product->pivot->quantity * $product->price )}}円(税込)
                            </div>
                        </div>

                        <div class="md:w-2/12">
                            <form action="{{route('user.cart.delete',['item'=>$product->id])}}" method="post">
                                @csrf
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg></button>

                                </form>
                            </div>
                    </div>
                    @endforeach
                    <div class="my-2">
                        小計: {{ number_format($totalPrice)}}<span class="text-sm
                       text-gray-700">円(税込)</span>
                       </div>
                       <div>
                        <button onclick="location.href='{{ route('user.cart.checkout')}}'" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"
                       >購入する
                        </button>
                       </div>
                    @else
                    カートに商品が入っていません
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>