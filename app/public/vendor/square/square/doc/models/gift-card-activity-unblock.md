
# Gift Card Activity Unblock

Present only when `GiftCardActivityType` is UNBLOCK.

## Structure

`GiftCardActivityUnblock`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `reason` | `string` | Required, Constant | **Default**: `'CHARGEBACK_UNBLOCK'` | getReason(): string | setReason(string reason): void |

## Example (as JSON)

```json
{
  "reason": "CHARGEBACK_UNBLOCK"
}
```

