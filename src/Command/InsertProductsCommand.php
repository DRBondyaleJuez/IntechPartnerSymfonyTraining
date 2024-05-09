<?php

//src/Command/CreateUserCommand.php
namespace App\Command;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(
    name: 'app:insert-products',
    description: 'Inserts the products described in the JSON file products.json in assets.'
    )]
class InsertProductsCommand extends Command
{

    private String $productsFilePath = './assets/data/products.json';

    public function __construct(
        private EntityManagerInterface $entityManager,
        private LoggerInterface $logger
    )
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            // the command description shown when running "php bin/console list"
            ->setDescription('Inserts the products described in the JSON file products.json in assets.')
            // the command help shown when running the command with the "--help" option
            ->setHelp('This command allows you to insert the products described in the JSON products.json file in assets.')
        ;

    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Beginning to add products form file ' . $this -> productsFilePath . ' ...'."\n"
             .'================================='
        ]);

        $productsFile = fopen($this->productsFilePath,"r") or die("Unable to open file!");
        $productListJson = fread($productsFile,filesize($this->productsFilePath));
        fclose($productsFile);

        //$productListJson = readfile($this->productsFilePath);
        //$productListJson = file_get_contents($this->productsFilePath);
        $productList = json_decode($productListJson,true);

        for($i = 0; $i < count($productList); $i++){
            $output->writeln([
                'Inserting product: ' .$productList[$i]['productid'] .'...'
            ]);
            $this->insertProduct($productList[$i]);
        }

        // ... put here the code to insert the product

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        $output->writeln([
            "\n".'================================='."\n"
            .'CURRENT PRODUCT TABLE STATE (productid|name): '."\n"
            .shell_exec("php bin/console dbal:run-sql 'SELECT productid, name FROM product'")
        ]);
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }

    private function insertProduct($productInfo)
    {
        $currentProduct = new Product();
        $currentProduct->setProductid($productInfo['productid']);
        $currentProduct->setName($productInfo['name']);
        $currentProduct->setDescription($productInfo['description']);
        $currentProduct->setPackage($productInfo['package']);
        $currentProduct->setContent($productInfo['content']);
        $currentProduct->setPrice(floatval($productInfo['price']));
        $currentProduct->setOfferprice(floatval($productInfo['offerprice']));
        $currentProduct->setTaxPercentage(floatval($productInfo['tax_percentage']));
        $currentProduct->setMediaurl($productInfo['mediaurl']);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $this->entityManager->persist($currentProduct);

        // actually executes the queries (i.e. the INSERT query)
        $this->entityManager->flush();


        return true;
    }

}