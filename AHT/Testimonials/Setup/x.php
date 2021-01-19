<?php
namespace AHT\Testimonials\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
class UpgradeSchema implements UpgradeSchemaInterface {
    public function upgrade(
   	 SchemaSetupInterface $setup,
   	 ModuleContextInterface $context
    ) {
   	 if (version_compare($context->getVersion(), '2.0.0') > 0) {
   		 $installer = $setup;
   		 $installer->startSetup();
   		 $connection = $installer->getConnection();
   		 //Install new database table
   		 $table = $installer->getConnection()->newTable($installer->getTable('aht_category'))
   		 ->addColumn(
   			 'category_id',
   			 \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
   			 null,[
   				 'identity' => true,
   				 'unsigned' => true,
   				 'nullable' => false,
   				 'primary' => true
   			 ],
   			 'Category Id'
   		 )->addColumn(
   			 'category_name',
   			 \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
   			 64,
   			 ['nullable' => false],
   			 'Category name'
   		 );
            $installer->getConnection()->createTable($table);
   		 $installer->endSetup();
   	 }
    }
}
