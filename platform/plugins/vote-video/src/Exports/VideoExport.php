<?php
/**
 * VideoExport.php
 * Created by: trainheartnet
 * Created at: 11/02/2022
 * Contact me at: longlengoc90@gmail.com
 */


namespace Botble\VideoVoting\Exports;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Table\Supports\TableExportHandler;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class VideoExport extends TableExportHandler
{
    /**
     * {@inheritDoc}
     */
    protected function afterSheet(AfterSheet $event)
    {
        parent::afterSheet($event);

        $totalRows = $this->collection->count() + 1;

        $event->sheet->getDelegate()
            ->getStyle('I1:I' . $totalRows)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $event->sheet
            ->getDelegate()
            ->getStyle('C1:C' . $totalRows)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $event->sheet->getDelegate()
            ->getColumnDimension('C')
            ->setWidth(40);

        for ($index = 2; $index <= $totalRows; $index++) {

            $this->drawingImage($event, 'B', $index);

            $status = $event->sheet->getDelegate()
                ->getStyle('I' . $index)
                ->getFont()
                ->getColor();

            $value = $event->sheet->getDelegate()
                ->getCell('I' . $index)
                ->getValue();

            if ($value == BaseStatusEnum::PUBLISHED) {
                $status->setARGB('1d9977');
            } else {
                $status->setARGB('dc3545');
            }

            $event->sheet
                ->getDelegate()
                ->getCell('I' . $index)
                ->setValue(BaseStatusEnum::getLabel($value));
        }
    }
}
