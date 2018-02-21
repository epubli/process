<?php

namespace Epubli\Process;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

abstract class BaseProcessBuilder implements ProcessBuilderInterface
{
    /**
     * @var ProcessBuilder
     */
    protected $builder;

    /**
     * @var string path to input file
     */
    private $inputFile;

    /**
     * @var string path to output file (or directory)
     */
    private $outputFile;

    /**
     * @param string $executable
     */
    public function __construct($executable)
    {
        $this->builder = new ProcessBuilder();
        $this->builder->setPrefix($executable);
    }

    /**
     * @return Process
     */
    public function getProcess()
    {
        if ($this->inputFile) {
            $this->builder->add($this->inputFile);
        }

        if ($this->outputFile) {
            if (!$this->inputFile) {
                // there must be an input file specified before the output file
                $this->builder->add('-');
            }
            $this->builder->add($this->outputFile);
        }

        return $this->builder->getProcess();
    }

    /**
     * Set the path to the input file.
     *
     * @param string $path path to input file
     * @return $this
     */
    public function setInputFile($path)
    {
        $this->inputFile = $path;

        return $this;
    }

    /**
     * Set input to stdin.
     *
     * @return $this
     */
    public function setInputStdin()
    {
        return $this->setInputFile('-');
    }

    /**
     * Set input data.
     *
     * @param string $input byte string handled as input stream/file
     * @return $this
     */
    public function setInput($input)
    {
        $this->builder->setInput($input);

        return $this->setInputStdin();
    }

    /**
     * Set the path to the output file.
     *
     * @param string $path path to output file (or directory)
     * @return $this
     */
    public function setOutputFile($path)
    {
        $this->outputFile = $path;

        return $this;
    }

    /**
     * Set stdout as output.
     *
     * @return $this
     */
    public function setOutputStdout()
    {
        return $this->setOutputFile('-');
    }
}
