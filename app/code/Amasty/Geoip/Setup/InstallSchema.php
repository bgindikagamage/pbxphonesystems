<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2019 Amasty (https://www.amasty.com)
 * @package Amasty_Geoip
 */


namespace Amasty\Geoip\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 */
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'amasty_geoip_block'
         */

        $table = $installer->getConnection()
            ->newTable($installer->getTable('amasty_geoip_block'))
            ->addColumn(
                'block_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Block Id'
            )
            ->addColumn(
                'start_ip_num',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Start Ip Num'
            )
            ->addColumn(
                'end_ip_num',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'End Ip Num'
            )
            ->addColumn(
                'geoip_loc_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Geoip Loc Id'
            )
            ->addColumn(
                'postal_code',
                Table::TYPE_TEXT,
                null,
                ['nullable' => true],
                'Postal Code'
            )
            ->addColumn(
                'latitude',
                Table::TYPE_FLOAT,
                null,
                ['nullable' => true],
                'Latitude'
            )
            ->addColumn(
                'longitude',
                Table::TYPE_FLOAT,
                null,
                ['nullable' => true],
                'Longitude'
            )
            ->setComment('Amasty Geoip Block Table')
            ->setOption('type', 'MyISAM');
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'amasty_geoip_location'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('amasty_geoip_location'))
            ->addColumn(
                'location_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Location Id'
            )
            ->addColumn(
                'geoip_loc_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Geoip Loc Id'
            )
            ->addColumn(
                'country',
                Table::TYPE_TEXT,
                null,
                ['nullable' => true],
                'Country'
            )
            ->addColumn(
                'city',
                Table::TYPE_TEXT,
                null,
                ['nullable' => true],
                'City'
            )
            ->setComment('Amasty Geoip Location Table')
            ->setOption('type', 'MyISAM');
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
