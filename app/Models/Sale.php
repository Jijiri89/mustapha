<?php
namespace App\Models;

use App\Models\Item;
use App\Models\User;
use App\Models\CreditSale;
use Emanate\BeemSms\Facades\BeemSms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'remarks',
        'buyer_name',
        'profit_or_loss',
        'quantity',
        'unitsp_updated',
        'is_credit_sale',
        'stock_balance_at_sale',
        'selling_price',
        'phone_number',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function creditsales(): HasMany
    {
        return $this->hasMany(CreditSale::class);
    }

    protected static function boot()
{
    parent::boot();

    // ... (existing code)

    static::creating(function ($sale) {
        $item = $sale->item;
    
        if ($item) {
            $unitsp = $item->unitsp;
            $quantity = $sale->quantity;
    
            if ($sale->remarks === 'deposit') {
                // Calculate selling price and profit_or_loss for deposit sales
                $sale->selling_price = $quantity * $unitsp;
                $costPrice = $item->unitcp;
                $sale->profit_or_loss = $sale->selling_price - ($quantity * $costPrice);
    
                // Maintain the stock balance and stock_balance_at_sale for deposit sales
                $sale->stock_balance_at_sale = $item->stock_balance;
              //  $sale->stock_balance = $item->stock_balance;
            } elseif ($sale->is_credit_sale) {
                // Calculate selling price and profit_or_loss for credit sales
                $sale->selling_price = 0;
                $sale->profit_or_loss = 0;
    
                // Adjust stock balance for credit sales
                $item->stock_balance -= $quantity;
    
                // Set stock_balance_at_sale to the current stock_balance for credit sales
                $sale->stock_balance_at_sale = $item->stock_balance;
              //  $sale->stock_balance = $item->stock_balance;
    
                // Save the item to update the stock balance for credit sales
                $item->save();
            } else {
                // Calculate selling price and profit_or_loss for regular sales
                $sale->selling_price = $quantity * $unitsp;
                $costPrice = $item->unitcp;
                $sale->profit_or_loss = ($unitsp - $costPrice) * $quantity;
    
                // Adjust stock balance for regular sales
                $item->stock_balance -= $quantity;
                $sale->stock_balance_at_sale = $item->stock_balance; // Set stock_balance for regular sales
    
                // Save the item to update the stock balance for regular sales
                $item->save();
    
                // Set stock_balance_at_sale to the current stock_balance for regular sales
                $sale->stock_balance_at_sale = $item->stock_balance;
            }
        } else {
            $sale->selling_price = 0;
            $sale->profit_or_loss = 0;
            $sale->stock_balance_at_sale = 0;
            $sale->stock_balance = 0;
        }
    });
    
    
    static::updating(function ($sale) {
        $item = $sale->item;
        
        if ($item) {
            $oldIsCreditSale = $sale->getOriginal('is_credit_sale');
            $newIsCreditSale = $sale->is_credit_sale;
    
            if ($oldIsCreditSale && !$newIsCreditSale) {
                // ... (existing code)
                $quantity = $sale->quantity;
                $unitsp = $item->unitsp;
    
                // Update the selling price based on the current quantity and unit selling price
                $sale->selling_price = $quantity * $unitsp;

    
                // Calculate the profit based on the current selling price and cost price
                $costPrice = $item->unitcp;
                $items=$item->title;
                $qty=$item->Quantity;
                $sale->profit_or_loss = ($unitsp - $costPrice) * $quantity;

                // Implement Beem SMS notification here
                $hardcodedPhoneNumbers = ['+233247266961', '+233598385900','+233542969398']; // Add your hardcoded phone numbers here
foreach ($hardcodedPhoneNumbers as $phoneNumber) {
    BeemSms::content('Congratulations! kindly be informed that ' . $sale->buyer_name . " has paid for GHS" . $sale->selling_price . ' as payment of credit sale of ' . $items.' bought on '. $sale->created_at)
        ->unpackRecipients($phoneNumber)
        ->send();
}

            }
             else {
                $oldQuantity = $sale->getOriginal('quantity');
                $newQuantity = $sale->quantity;
                $quantityChange = $oldQuantity - $newQuantity;
    
                $oldRemarks = $sale->getOriginal('remarks');
                $newRemarks = $sale->remarks;
    
                if (($oldRemarks === 'deposit'|| $oldRemarks === 'partial') && $newRemarks === 'partial') {
                    $quantity = $sale->quantity;
                    $unitsp = $item->unitsp;
                    $costPrice = $item->unitcp;

                    $quantityChanges = $oldQuantity - $newQuantity;
    
                   // $sale->selling_price = $quantity * $unitsp;
                  //  $sale->profit_or_loss = ($unitsp - $costPrice) * $quantity;
                  $items=$item->title;
    
                    $newStockBalance = $item->stock_balance - $quantityChanges;
                    $sale->stock_balance_at_sale = $newStockBalance;
    
                    $item->stock_balance = $newStockBalance;
                    $item->save();
                     // Implement Beem SMS notification here
                $hardcodedPhoneNumbers = ['+233247266961', '+233598385900','+233542969398']; // Add your hardcoded phone numbers here
foreach ($hardcodedPhoneNumbers as $phoneNumber) {
    BeemSms::content('kindly be informed that ' . $quantityChanges. ' of '.$items=$item->title. " has been partially taken by " .$sale->buyer_name . " who deposited on ". $sale->created_at)
        ->unpackRecipients($phoneNumber)
        ->send();
}
    
                } else if (($oldRemarks === 'deposit' || $oldRemarks === 'partial') && $newRemarks === 'delivered') {

                    $newQuantity = $sale->quantity;
                    $quantityChange = $oldQuantity - $newQuantity;

                    $newStockBalance = $item->stock_balance - $newQuantity;
                    $sale->stock_balance_at_sale = $newStockBalance;
                    $item->stock_balance = $newStockBalance;
                    $item->save();

                    
                    $hardcodedPhoneNumbers = ['+233247266961', '+233598385900','+233542969398']; // Add your hardcoded phone numbers here
foreach ($hardcodedPhoneNumbers as $phoneNumber) {
    BeemSms::content('kindly be informed that all the ' . $items = $item->title . " has been fully delivered to " . $sale->buyer_name . " who deposited on " . $sale->created_at)
        ->unpackRecipients($phoneNumber)
        ->send();
}
                } else {
                    // Calculate the new selling price based on the updated quantity and unitsp for other cases
                  //  $unitsp = $item->unitsp;
                 //   $newSellingPrice = $newQuantity * $unitsp;

                 $quantity = $sale->quantity;
                    $unitsp = $item->unitsp;
                    $costPrice = $item->unitcp;
    
                   $sale->selling_price = $quantity * $unitsp;
                    $sale->profit_or_loss = ($unitsp - $costPrice) * $quantity;
    
                    // ... (rest of the logic for other cases)
    
                    // Update the stock balance and stock_balance_at_sale for other cases
                    $newStockBalance = $item->stock_balance + $quantityChange;
                    $sale->stock_balance_at_sale = $newStockBalance;
                    $item->stock_balance = $newStockBalance;
                    $item->save();
                }
            }
        }
    });
    
    
    
    
            static::deleting(function ($sale) {
                $item = $sale->item;
    
                if ($item && !$sale->is_credit_sale) {
                    $quantity = $sale->quantity;
    
                    // Calculate the profit change based on the quantity being deleted
                    $unitsp = $item->unitsp;
                    $costPrice = $item->unitcp;
                    $profitChange = ($unitsp - $costPrice) * $quantity;
    
                    // Subtract the profit change from the profit_or_loss attribute
                    $sale->profit_or_loss -= $profitChange;
    
                    // Adjust the stock balance by adding back the deleted sale quantity
                    $item->stock_balance += $quantity;
                }
            });
        }
    }
    //correct codes