<?php

namespace App\Orchid\Screens\Order;

use App\Models\Order;

use App\Models\OrderProduct;
use App\Orchid\Layouts\OrderProduct\OrderProductListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;

use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Picture;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Fields\Select;

use App\Models\NpCity;
use App\Models\NpWarehouse;

use App\Models\UkrPostCity;
use App\Models\UkrPostWarehouse;

use App\Orchid\Layouts\Deliver;
use App\Orchid\Layouts\Deliver\DeliverListener;
use App\Enums\OrderStatus;
use App\Enums\TypeDeliver;
use App\Enums\TypePaymentMethod;
use App\Orchid\Layouts\OrderPay\OrderPayListener;
class OrderEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $order;
    public $order_product;
    public function query(Order $order): array
    {
        return [
            'order' => $order,
            'order_product' => OrderProduct::where('order_id',$order->id)->get()
            
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __("Edit order",["number"=>$this->order->id]);
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [


            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->order->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->order->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            
            Layout::rows([
                Input::make('order.first_name')
                    ->required()
                    ->title('firstName_title'),

                Input::make('order.last_name')
                    ->required()
                    ->title('lastName_title'),

                Input::make('order.middle_name')
                    ->title('MiddleName_title'),

                Input::make('order.phone')
                    ->type('text')
                    ->required()
                    ->title(__('Phone_title'))
                    ->mask('+38(999) 999-99-99')
                    ->placeholder(__('Phone_title')),

                Input::make('order.email')
                    ->required()
                    ->title('Email'),
               
                
                Select::make('order.status')
                    ->fromEnum(OrderStatus::class,'getDescription')
                    ->required()
                    ->title(__('Status')),

                
                    
                TextArea::make('order.comment')
                    ->title(__('Notes to the order')),
                
                Input::make('order.promocode.code')
                    ->readonly()
                    //->value($this->order->promocode->code)
                    ->canSee(!empty($this->order->promocode_id))
                    ->title('Promocode')

            ]),
            OrderPayListener::class,
            DeliverListener::class,
            OrderProductListLayout::class
        ];
    }
  
    public function createOrUpdate(Request $request)
    {
      //  dd($request->get('order'));
        $delivery['deliver'] = $request->get('order')['deliver_type'];
        if($request->get('order')['deliver_type'] == TypeDeliver::NP->name) {
            $delivery['city_np'] = NpCity::where('id',$request->get('order')['np_city_id'])->pluck('Description')->first();
            $delivery['warehouse_np'] = NpWarehouse::where('id',$request->get('order')['np_warehouse_id'])->pluck('Description')->first();
            $delivery['warehouse_ref'] = NpWarehouse::where('id',$request->get('order')['np_warehouse_id'])->pluck('Ref')->first();
            
            $delivery['city_ref'] = NpCity::where('id',$request->get('order')['np_city_id'])->pluck('Ref')->first();
        } else if ($request->get('order')['deliver_type'] == TypeDeliver::NP_COURIER->name) {
            $delivery['city_np'] = NpCity::where('id',$request->get('order')['np_city_id'])->pluck('Description')->first();
            $delivery['city_ref'] = NpCity::where('id',$request->get('order')['np_city_id'])->pluck('Ref')->first();
            $delivery['np_courier_address'] = $request->get('order')['np_courier_address'];
        } else if ($request->get('order')['deliver_type'] == TypeDeliver::SELF_DELIVERY->name) {
            $delivery['np_self_address'] = $request->get('order')['np_self_address'];

            
        } else if($request->get('order')['deliver_type'] == TypeDeliver::UKRPOSHTA->name) {
            $delivery['city_ukr_post'] = UkrPostCity::where('id',$request->get('order')['ukr_post_city_id'])->pluck('name')->first();
            $delivery['warehouse_ukr_pos'] = UkrPostWarehouse::where('id',$request->get('order')['ukr_post_warehouse_id'])->pluck('address')->first();
            $delivery['id_city_ukr_post'] = UkrPostCity::where('id',$request->get('order')['ukr_post_city_id'])->pluck('city_id')->first();
            
            $delivery['postcode_warehouse_ukr_pos'] = UkrPostWarehouse::where('id',$request->get('order')['ukr_post_warehouse_id'])->pluck('postindex')->first();
        }
        $this->order->delivery = $delivery;

      //  dd($request->get('order')['pay_type']);
        $pay['pay_title'] = $request->get('order')['pay_type'];
        if($request->get('order')['pay_type'] == TypePaymentMethod::INSTALLMENT_PRIVATBANK->name) {
            $pay['credit_pb_count'] = $request->get('order')['credit_count'];
            $pay['credit_pb_type'] = $request->get('order')['type_installment'];

        }
        if($request->get('order')['pay_type'] == TypePaymentMethod::LEGAL_ACCOUNT_CURRENT->name) {
            $pay['edrpu_legal'] = $request->get('order')['edrpu_legal'];
            $pay['full_name_legal'] = $request->get('order')['full_name_legal'];

        }
        if($request->get('order')['pay_type'] == TypePaymentMethod::INDIVIDUALS_ACCOUNT_CURRENT->name) {
            $pay['full_name_acount'] = $request->get('order')['full_name_acount'];
            $pay['tin_acount'] = $request->get('order')['tin_acount'];

        }

        $this->order->pay_info = $pay;


        $this->order->fill($request->get('order'))->save();

        $title_operation = $this->order->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.order.edit',$this->order->id);
    }
    public function remove()
    {

        $this->order->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.order.list');
    }
}
